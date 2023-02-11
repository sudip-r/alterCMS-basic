<?php

namespace App\Http\Controllers\alterCMS\Category;

use App\AlterBase\Models\Category\Category;
use App\AlterBase\Repositories\Category\CategoryRepository;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class CategoryController extends Controller
{
  /**
   * CategoryRepository $category
   */
  private $category;

  /**
   * @var DatabaseManager
   */
  private $db;

  /**
   * @var LoggerInterface
   */
  private $log;

  /**
   * CategoryController constructor.
   * @param CategoryRepository $category
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    CategoryRepository $category,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->category = $category;
    $this->db   = $db;
    $this->log  = $log;
  }

  /**
   * Show all category
   *
   * @return View
   */
  public function index()
  {
    $this->authorize('view', Category::class);
    $categories = $this->category->paginate();
    return view('cms.category.index')->with('categories', $categories);
  }

  /**
   * Show form to create new category
   *
   * @return View
   */
  public function create()
  {
    $this->authorize('create', Category::class);
    $categories = $this->category->getWithCondition(['publish' => 1])->pluck('category', 'id');
    return view('cms.category.create')
      ->with('categories', $categories);
  }

  /**
   * Store newly created category
   *
   * @param CategoryRequest $request
   * @return $this|\Illuminate\Http\RedirectResponse
   */
  public function store(CategoryRequest $request)
  {
    $this->authorize('create', Category::class);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'category', 'slug', 'parent', 'type'
      ]);

      $input['publish'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;

      if ($request->hasFile('icon_dark')) {
        $input['icon_dark'] = uploadImage($request, 'icon_dark', 'uploads/');
      }

      if ($request->hasFile('icon_light')) {
        $input['icon_light'] = uploadImage($request, 'icon_light', 'uploads/');
      }

      $this->category->store($input);

      $this->db->commit();

      return redirect()->route('cms::categories.index')
        ->with('success', "Category added successfully.");
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::categories.create')
        ->with('error', "Failed to add tag. " . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Show form to edit category
   *
   * @param Category $category
   * @return View
   */
  public function edit(Category $category)
  {
    $this->authorize('update', Category::class);
    $categories = $this->category->getWithCondition(['publish' => 1])->pluck('category', 'id');
    return view('cms.category.edit')
      ->with('category', $category)
      ->with('categories', $categories);
  }

  /**
   * Update category detail
   *
   * @param ProductCategoryRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(CategoryRequest $request, $id)
  {
    $this->authorize('update', Category::class);

    $category = $this->category->find($id);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'category', 'slug', 'parent', 'type'
      ]);
      $input['publish'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;

      if ($request->hasFile('icon_dark')) {
        $input['icon_dark'] = uploadImage($request, 'icon_dark', 'uploads/');
        if ($category->icon_dark != 'default.png')
          $this->deleteImage($category->icon_dark);
      }

      if ($request->hasFile('icon_light')) {
        $input['icon_light'] = uploadImage($request, 'icon_light', 'uploads/');
        if ($category->icon_light != 'default.png')
          $this->deleteImage($category->icon_light);
      }

      $this->category->update($id, $input);
      $this->db->commit();


      return redirect()->route('cms::categories.index')
        ->with('success', 'Category updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::categories.edit', ['category' => $id])
        ->with('error', 'Filed to update category. ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete given category
   *
   * @param Category $category
   * @return string
   */
  public function delete(Category $category)
  {
    $this->authorize('delete', Category::class);

    $child = $this->category->findWithCondition(['parent' => $category->id]);
    if ($child != null && count($child->toArray()) != 0)
      return redirect()->route('cms::categories.index')
        ->with('error', 'Failed to delete category. Delete child categories first');
    try {
      $this->db->beginTransaction();
      $this->category->delete($category->id);

      if ($category->icon_dark != 'default.png')
        $this->deleteImage($category->icon_dark);

      if ($category->icon_light != 'default.png')
        $this->deleteImage($category->icon_light);

      $this->db->commit();
      return redirect()->route('cms::categories.index')
        ->with('success', 'Category deleted successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::categories.index')
        ->with('error', 'Filed to delete category.')
        ->withInput();
    }
  }

  /**
   * Delete unused icons
   * 
   * @param $image
   */
  private function deleteImage($image)
  {
    if (file_exists(public_path('uploads/' . $image)))
      unlink(public_path('uploads/' . $image));
  }
}
