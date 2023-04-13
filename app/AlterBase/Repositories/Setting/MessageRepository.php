<?php

namespace App\AlterBase\Repositories\Setting;

use App\AlterBase\Repositories\Repository;

class MessageRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\AlterBase\Models\Setting\Message';
    }

    /**
     * Get message thread
     * 
     * @param $id
     * @param $sender
     * @return Collection
     */
    public function getMessageThread($id, $sender)
    {
        $q = $this->model;
        $q = $this->model->where(['user_id' => $id]);

        $q = $q->where(function ($query) use ($sender) {
            $query->where('message_from', '=', $sender)
                ->orWhere('message_to', '=', $sender);
        });

        return $q->orderBy('id', 'desc')->paginate(100, ['*']);
    }
}