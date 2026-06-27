<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'code_book' => 'BK001',
                'isbn_book' => '978-3-16-148410-0',
                'title_book' => 'The Great Gatsby',
                'author_book' => 'F. Scott Fitzgerald',
                'publisher_book' => 'Scribner',
                'published_year' => 1925,
                'description_book' => 'A novel set in the Roaring Twenties, exploring themes of wealth, love, and the American Dream.',
                'stock' => 10,
                'created_at' => date('2026-05-14 16:33:59'),
                'updated_at' => date('2026-05-14 16:33:59'),
            ],
            [
                'code_book' => 'BK002',
                'isbn_book' => '978-0-14-028333-4',
                'title_book' => 'To Kill a Mockingbird',
                'author_book' => 'Harper Lee',
                'publisher_book' => 'J.B. Lippincott & Co.',
                'published_year' => 1960,
                'description_book' => 'A novel about racial injustice in the Deep South, seen through the eyes of a young girl.',
                'stock' => 5,
                'created_at' => date('2026-05-14 16:33:59'),
                'updated_at' => date('2026-05-14 16:33:59'),
            ],
            [
                'code_book' => 'BK003',
                'isbn_book' => '978-0-452-28423-4',
                'title_book' => '1984',
                'author_book' => 'George Orwell',
                'publisher_book' => 'Secker & Warburg',
                'published_year' => 1949,
                'description_book' => 'A dystopian novel that explores the dangers of totalitarianism and extreme political ideology.',
                'stock' => 8,
                'created_at' => date('2026-05-14 16:33:59'),
                'updated_at' => date('2026-05-14 16:33:59'),
            ]
        ];

        $this->db->table('books')->insertBatch($data);
    }
}