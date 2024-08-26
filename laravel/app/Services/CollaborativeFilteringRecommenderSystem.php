<?php

namespace App\Services;

use App\Models\Club;
use App\Models\Event;
use App\Models\Eventcategory;
use App\Models\Participant;
use App\Models\Rating;
use App\Models\Student;


class CollaborativeFilteringRecommenderSystem
{
    public function suggestTopEvents(Club $club)
    {
        // Get all events organized by the club
        $events = $club->event;

        // Calculate scores for each event based on ratings
        $eventScores = [];
        foreach ($events as $event) {
            $eventScores[$event->id] = $this->calculateEventScore($event);
        }

        // Sort events by scores in descending order
        arsort($eventScores);

        // Return the top 5 events
        return array_slice($eventScores, 0, 5, true);
    }

    public function calculateEventScore(Event $event)
    {
        $totalParticipants = 0;
        foreach ($event->participant as $participant) {
            $rating = $participant->rating->rating_event ?? null;
            if ($rating >= 3) {
                $totalParticipants++;
            }
        }

        return $totalParticipants;
    }

    public function TopEventCategories ()
    {
        //Return Top 5 EventCategories
        // Count occurrences of each event category picked by students
        $topEventCategories = Eventcategory::select('eventcategory.id', 'eventcategory.eventcategory_name')
            ->leftJoin('student', 'student.eventcategory_id', '=', 'eventcategory.id')
            ->selectRaw('eventcategory.id, eventcategory.eventcategory_name, count(student.id) as student_count')
            ->groupBy('eventcategory.id', 'eventcategory.eventcategory_name')
            ->orderByDesc('student_count')
            ->limit(5)
            ->get();

        return $topEventCategories;
    }

    public function recommendationEventCategories()
    {
        //Return List of Event Categories that recommended based on count event category choice by student and result of event rating above 3
        // Step 1: Get the count of event category choices by students
        $eventCategoryCounts = Eventcategory::select('eventcategory.id', 'eventcategory.eventcategory_name')
        ->leftJoin('student', 'student.eventcategory_id', '=', 'eventcategory.id')
        ->selectRaw('eventcategory.id, eventcategory.eventcategory_name, count(student.id) as student_count')
        ->groupBy('eventcategory.id', 'eventcategory.eventcategory_name')
        ->orderByDesc('student_count')
        ->get();

        // Step 2: Calculate ratings for each event category based on events with rating above 3
        $eventCategoryRatings = Eventcategory::select('eventcategory.id', 'eventcategory.eventcategory_name')
            ->leftJoin('event', 'event.eventcategory_id', '=', 'eventcategory.id')
            ->leftJoin('participant', 'participant.event_id', '=', 'event.id')
            ->leftJoin('rating', 'rating.participant_id', '=', 'participant.id')
            ->selectRaw('eventcategory.id, eventcategory.eventcategory_name, avg(rating.rating_event >= 3) as category_rating')
            ->groupBy('eventcategory.id', 'eventcategory.eventcategory_name')
            ->orderByDesc('category_rating')
            ->get();

        // dd($eventCategoryRatings);

        // Step 3: Calculate Cosine Similarity for event categories based on counts and ratings
        $eventCategorySimilarity = [];
        foreach ($eventCategoryCounts as $count) {
            $eventCategorySimilarity[$count->id] = ['count' => $count->student_count, 'rating' => 0];
        }

        foreach ($eventCategoryRatings as $rating) {
            if (isset($eventCategorySimilarity[$rating->id])) {
                $eventCategorySimilarity[$rating->id]['rating'] = $rating->category_rating;
            } else {
                $eventCategorySimilarity[$rating->id] = ['count' => 0, 'rating' => $rating->category_rating];
            }
        }

        // dd($eventCategorySimilarity);

        // Step 4: Normalize the vectors and calculate cosine similarity
        $similarityScores = [];
        $resultDotProduct = [];
        foreach ($eventCategorySimilarity as $categoryId => $category) {
            foreach ($eventCategorySimilarity as $compareCategoryId => $compareCategory) {
                if ($categoryId != $compareCategoryId) {
                    $dotProduct1 = $category['count'] * $compareCategory['count'];
                    $dotProduct2 = $category['rating'] * $compareCategory['rating'];
                    $dotProduct = $dotProduct1 + $dotProduct2;
                    $magnitude1 = sqrt($category['count'] ** 2 + $category['rating'] ** 2);
                    $magnitude2 = sqrt($compareCategory['count'] ** 2 + $compareCategory['rating'] ** 2);

                    if ($magnitude1 != 0 && $magnitude2 != 0) {
                        $cosineSimilarity = $dotProduct / ($magnitude1 * $magnitude2);
                    } else {
                        $cosineSimilarity = 0; // Handle division by zero or empty vectors
                    }

                    if (!isset($similarityScores[$categoryId])) {
                        $similarityScores[$categoryId] = [];
                        $resultDotProduct[$categoryId] = [];
                    }

                    $similarityScores[$categoryId][$compareCategoryId] = $cosineSimilarity;
                    $resultDotProduct[$categoryId][$compareCategoryId] = $dotProduct;
                }
            }
        }

        // dd($similarityScores);

        // Step 5: Sort and get top 5 event categories
        $topEventCategories = [];
        foreach ($similarityScores as $categoryId => $scores) {
            $averageScore = array_sum($scores) / count($scores);
            $topEventCategories[$categoryId] = $averageScore;
        }

        arsort($topEventCategories);
        // $topEventCategories = array_slice($topEventCategories, 0, 5, true);

        // Step 6: Retrieve event category names
        // $recommendedCategories = Eventcategory::whereIn('id', array_keys($topEventCategories))->get();

        return array_slice($topEventCategories, 0, 5, true);
    }
}
