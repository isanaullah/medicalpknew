<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = Lesson::all();
        if ($lessons->isEmpty()) {
            return;
        }

        $quizDefinitions = [
            [
                'lesson_index' => 0,
                'title' => 'Web Architecture & HTTP Mastery Assessment',
                'instructions' => 'Read each question carefully. Select the most accurate answer before submitting.',
                'description' => 'Test your understanding of DNS resolution, HTTP request-response flow, and TCP connections.',
                'time_limit_minutes' => 15,
                'passing_percentage' => 75,
                'attempt_limit' => 3,
                'status' => 'Published',
                'questions' => [
                    [
                        'text' => 'Which HTTP status code signifies that a resource has been permanently moved to a new URL?',
                        'type' => 'multiple_choice',
                        'marks' => 2,
                        'explanation' => 'HTTP 301 indicates Permanent Redirect, whereas 302 is temporary.',
                        'options' => ['200 OK', '301 Moved Permanently', '404 Not Found', '500 Internal Server Error'],
                        'correct' => 1,
                    ],
                    [
                        'text' => 'HTTP is a stateful protocol that automatically remembers previous client transactions.',
                        'type' => 'true_false',
                        'marks' => 1,
                        'explanation' => 'HTTP is inherently stateless; sessions and cookies are used to track state.',
                        'options' => ['True', 'False'],
                        'correct' => 1, // False
                    ],
                ],
            ],
            [
                'lesson_index' => 1,
                'title' => 'HTML5 Semantics & Accessibility Knowledge Check',
                'instructions' => 'Answer both questions to verify your grasp of semantic tags and ARIA guidelines.',
                'description' => 'Evaluates your comprehension of accessible landmark tags and document outline rules.',
                'time_limit_minutes' => 10,
                'passing_percentage' => 70,
                'attempt_limit' => 2,
                'status' => 'Published',
                'questions' => [
                    [
                        'text' => 'Which HTML element represents dominant, non-repeated content unique to the document?',
                        'type' => 'multiple_choice',
                        'marks' => 2,
                        'explanation' => 'The <main> element represents the central content unique to the specific document.',
                        'options' => ['<section>', '<article>', '<main>', '<aside>'],
                        'correct' => 2,
                    ],
                    [
                        'text' => 'A webpage should only ever have one primary <h1> element for clear document hierarchy.',
                        'type' => 'true_false',
                        'marks' => 1,
                        'explanation' => 'SEO and accessibility best practices recommend exactly one <h1> heading per page.',
                        'options' => ['True', 'False'],
                        'correct' => 0, // True
                    ],
                ],
            ],
            [
                'lesson_index' => 2,
                'title' => 'Flexbox & CSS Grid Alignment Quiz',
                'instructions' => 'Test your mastery of CSS axes, alignment properties, and responsive grid declarations.',
                'description' => 'Questions on justify-content, align-items, grid-template-columns, and flex-direction.',
                'time_limit_minutes' => 12,
                'passing_percentage' => 80,
                'attempt_limit' => 2,
                'status' => 'Published',
                'questions' => [
                    [
                        'text' => 'In Flexbox with flex-direction: row, which property aligns flex items along the cross axis?',
                        'type' => 'multiple_choice',
                        'marks' => 2,
                        'explanation' => 'align-items controls cross-axis alignment, while justify-content controls the main axis.',
                        'options' => ['justify-content', 'align-items', 'align-content', 'flex-basis'],
                        'correct' => 1,
                    ],
                    [
                        'text' => 'CSS Grid is inherently two-dimensional while Flexbox is primarily one-dimensional.',
                        'type' => 'true_false',
                        'marks' => 1,
                        'explanation' => 'Flexbox handles items in a row OR a column, whereas Grid handles rows AND columns simultaneously.',
                        'options' => ['True', 'False'],
                        'correct' => 0, // True
                    ],
                ],
            ],
            [
                'lesson_index' => 3,
                'title' => 'Python Environment & Package Management Quiz',
                'instructions' => 'Verify your understanding of virtual environments and package isolation.',
                'description' => 'Covers PIP commands, virtual environments, and python versioning.',
                'time_limit_minutes' => 10,
                'passing_percentage' => 70,
                'attempt_limit' => 2,
                'status' => 'Published',
                'questions' => [
                    [
                        'text' => 'Which command creates an isolated virtual environment named "venv" in standard Python 3?',
                        'type' => 'multiple_choice',
                        'marks' => 2,
                        'explanation' => 'python -m venv venv uses the built-in venv module to create a new virtual environment.',
                        'options' => ['pip install venv', 'python -m venv venv', 'python new env venv', 'pip freeze venv'],
                        'correct' => 1,
                    ],
                    [
                        'text' => 'Freezing requirements with "pip freeze > requirements.txt" saves current package versions.',
                        'type' => 'true_false',
                        'marks' => 1,
                        'explanation' => 'pip freeze outputs exact installed versions to recreate the environment reliably.',
                        'options' => ['True', 'False'],
                        'correct' => 0, // True
                    ],
                ],
            ],
            [
                'lesson_index' => 4,
                'title' => 'CSV File Processing & Scripting Quiz',
                'instructions' => 'Assess your knowledge of reading and parsing tabular files in Python.',
                'description' => 'Covers DictReader, file context managers, and delimiter handling.',
                'time_limit_minutes' => 15,
                'passing_percentage' => 70,
                'attempt_limit' => 3,
                'status' => 'Published',
                'questions' => [
                    [
                        'text' => 'Why is using "with open(...) as f" preferred when manipulating files in Python?',
                        'type' => 'multiple_choice',
                        'marks' => 2,
                        'explanation' => 'The with context manager ensures the file stream is cleanly closed even if an exception occurs.',
                        'options' => ['It makes the file execute faster', 'It automatically closes the file upon exit', 'It encrypts the file', 'It creates a backup copy'],
                        'correct' => 1,
                    ],
                    [
                        'text' => 'csv.DictReader treats each row of a CSV as a dictionary with column header keys.',
                        'type' => 'true_false',
                        'marks' => 1,
                        'explanation' => 'DictReader automatically maps each record into a dictionary using the first row as field names.',
                        'options' => ['True', 'False'],
                        'correct' => 0, // True
                    ],
                ],
            ],
            [
                'lesson_index' => 5,
                'title' => 'SQL Relational Queries & Joins Quiz',
                'instructions' => 'Determine matching records across foreign key relationships.',
                'description' => 'Covers INNER JOIN, LEFT JOIN, FULL OUTER JOIN, and GROUP BY clauses.',
                'time_limit_minutes' => 20,
                'passing_percentage' => 80,
                'attempt_limit' => 2,
                'status' => 'Published',
                'questions' => [
                    [
                        'text' => 'Which JOIN returns all rows from the left table and matched rows from the right table, filling nulls if unmatched?',
                        'type' => 'multiple_choice',
                        'marks' => 2,
                        'explanation' => 'LEFT JOIN (or LEFT OUTER JOIN) guarantees all rows from the left relation are retained.',
                        'options' => ['INNER JOIN', 'RIGHT JOIN', 'LEFT JOIN', 'CROSS JOIN'],
                        'correct' => 2,
                    ],
                    [
                        'text' => 'WHERE clauses can directly filter aggregated results produced by GROUP BY.',
                        'type' => 'true_false',
                        'marks' => 1,
                        'explanation' => 'HAVING is required to filter aggregate results; WHERE filters raw rows before aggregation.',
                        'options' => ['True', 'False'],
                        'correct' => 1, // False
                    ],
                ],
            ],
            [
                'lesson_index' => 6,
                'title' => 'Pandas DataFrames Manipulation Quiz',
                'instructions' => 'Test your proficiency with indexing, filtering, and summary metrics in Pandas.',
                'description' => 'Covers df.loc, df.iloc, df.groupby(), and handling missing data.',
                'time_limit_minutes' => 15,
                'passing_percentage' => 75,
                'attempt_limit' => 2,
                'status' => 'Published',
                'questions' => [
                    [
                        'text' => 'Which Pandas method is used to remove rows containing null or NaN values?',
                        'type' => 'multiple_choice',
                        'marks' => 2,
                        'explanation' => 'df.dropna() drops null values along the specified axis.',
                        'options' => ['df.remove_nulls()', 'df.dropna()', 'df.fillna()', 'df.clean()'],
                        'correct' => 1,
                    ],
                    [
                        'text' => 'df.iloc indexes rows and columns by integer position rather than label name.',
                        'type' => 'true_false',
                        'marks' => 1,
                        'explanation' => 'iloc is strictly integer-position based, whereas loc is label-based.',
                        'options' => ['True', 'False'],
                        'correct' => 0, // True
                    ],
                ],
            ],
            [
                'lesson_index' => 7,
                'title' => 'UX Research & User Problem Definition Quiz',
                'instructions' => 'Evaluates user discovery practices and qualitative interview techniques.',
                'description' => 'Affinity mapping, persona formulation, and qualitative synthesis.',
                'time_limit_minutes' => 15,
                'passing_percentage' => 70,
                'attempt_limit' => 3,
                'status' => 'Published',
                'questions' => [
                    [
                        'text' => 'What is the primary danger of asking leading questions during user discovery interviews?',
                        'type' => 'multiple_choice',
                        'marks' => 2,
                        'explanation' => 'Leading questions bias the participant toward confirming the interviewer\'s pre-existing hypothesis.',
                        'options' => ['Interviews take too long', 'They introduce bias and invalidate honest insights', 'Users refuse to speak', 'It violates copyright'],
                        'correct' => 1,
                    ],
                    [
                        'text' => 'A user persona should be based on real empirical research rather than imagined assumptions.',
                        'type' => 'true_false',
                        'marks' => 1,
                        'explanation' => 'Actionable personas represent synthesized patterns from authentic user research.',
                        'options' => ['True', 'False'],
                        'correct' => 0, // True
                    ],
                ],
            ],
            [
                'lesson_index' => 8,
                'title' => 'Figma Components & Design Systems Quiz',
                'instructions' => 'Check your knowledge of design tokens, variants, and component architecture.',
                'description' => 'Covers component properties, auto layout, and token handoff.',
                'time_limit_minutes' => 12,
                'passing_percentage' => 75,
                'attempt_limit' => 2,
                'status' => 'Published',
                'questions' => [
                    [
                        'text' => 'Which Figma feature allows combining multiple state variations of a component into a single container?',
                        'type' => 'multiple_choice',
                        'marks' => 2,
                        'explanation' => 'Component Variants allow grouping states like Hover, Pressed, and Disabled.',
                        'options' => ['Smart Animate', 'Variants', 'Vector Networks', 'Masking'],
                        'correct' => 1,
                    ],
                    [
                        'text' => 'Figma Auto Layout frames cannot contain nested Auto Layout frames.',
                        'type' => 'true_false',
                        'marks' => 1,
                        'explanation' => 'Auto Layout frames can be nested indefinitely to build complex responsive UIs.',
                        'options' => ['True', 'False'],
                        'correct' => 1, // False
                    ],
                ],
            ],
            [
                'lesson_index' => 9,
                'title' => 'Git Branching & Pull Requests Quiz',
                'instructions' => 'Assess your understanding of collaborative Git workflows and conflict resolution.',
                'description' => 'Covers branching conventions, fast-forward merges, and code review standards.',
                'time_limit_minutes' => 10,
                'passing_percentage' => 70,
                'attempt_limit' => 2,
                'status' => 'Published',
                'questions' => [
                    [
                        'text' => 'Which command creates and immediately switches to a new Git branch called "feature-login"?',
                        'type' => 'multiple_choice',
                        'marks' => 2,
                        'explanation' => 'git checkout -b feature-login (or git switch -c feature-login) creates and checks out the branch.',
                        'options' => ['git branch feature-login', 'git checkout -b feature-login', 'git merge feature-login', 'git push feature-login'],
                        'correct' => 1,
                    ],
                    [
                        'text' => 'A pull request allows peers to review and discuss changes before merging into the main branch.',
                        'type' => 'true_false',
                        'marks' => 1,
                        'explanation' => 'Pull requests facilitate peer review, automated tests, and code quality control.',
                        'options' => ['True', 'False'],
                        'correct' => 0, // True
                    ],
                ],
            ],
        ];

        foreach ($quizDefinitions as $qDef) {
            $lesson = $lessons->get($qDef['lesson_index']) ?? $lessons->first();

            $quiz = Quiz::updateOrCreate(
                [
                    'lesson_id' => $lesson->id,
                    'title' => $qDef['title'],
                ],
                [
                    'instructions' => $qDef['instructions'],
                    'description' => $qDef['description'],
                    'time_limit_minutes' => $qDef['time_limit_minutes'],
                    'passing_percentage' => $qDef['passing_percentage'],
                    'attempt_limit' => $qDef['attempt_limit'],
                    'status' => $qDef['status'],
                    'total_marks' => 0,
                ]
            );

            // Seed questions
            foreach ($qDef['questions'] as $qIdx => $qData) {
                $question = QuizQuestion::updateOrCreate(
                    [
                        'quiz_id' => $quiz->id,
                        'question_text' => $qData['text'],
                    ],
                    [
                        'question_type' => $qData['type'],
                        'marks' => $qData['marks'],
                        'order' => $qIdx + 1,
                        'explanation' => $qData['explanation'],
                    ]
                );

                // Options
                $question->options()->delete();
                foreach ($qData['options'] as $optIdx => $optText) {
                    QuizQuestionOption::create([
                        'quiz_question_id' => $question->id,
                        'option_text' => $optText,
                        'is_correct' => ($optIdx === $qData['correct']),
                        'order' => $optIdx + 1,
                    ]);
                }
            }

            $quiz->recalculateTotalMarks();
        }
    }
}
