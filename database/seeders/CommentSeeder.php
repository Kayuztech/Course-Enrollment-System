<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Enrollment;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $enrollments = Enrollment::all();

        foreach ($enrollments as $enrollment) {
            // Each enrollment adds 2 comments
            for ($i = 0; $i < 2; $i++) {
                Comment::create([
                    'user_id' => $enrollment->user_id,
                    'course_id' => $enrollment->course_id,
                    'message' => 'This is a test comment by user ID ' . $enrollment->user_id,
                ]);
            }
        }
    }
}