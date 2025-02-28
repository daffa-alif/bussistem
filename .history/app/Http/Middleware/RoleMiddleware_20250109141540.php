    <?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class RoleMiddleware
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @param  string  $role
         * @return mixed
         */
        public function handle(Request $request, Closure $next, $role)
        {
            // Redirect to login if the user is not authenticated
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
            }

            // Check if the user's role matches the required role
            $user = Auth::user();

            if ($user->role !== $role) {
                return response()->view('errors.403', [
                    'message' => 'You do not have permission to access this resource.',
                ], 403);
            }

            return $next($request);
        }
    }
