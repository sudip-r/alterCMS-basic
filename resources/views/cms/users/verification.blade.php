Click here to verify your account: <a href="{{ $link = route('cms::users.verification.check', $user->verification_token) . '?email=' . urlencode($user->email) }}">{{ $link }}</a>
