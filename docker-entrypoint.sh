#!/bin/bash
set -e

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Seed database if empty
echo "Checking database seed..."
php artisan tinker --execute="if (\App\Models\Category::count() === 0) { \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]); }"

# Execute CMD
exec "$@"
