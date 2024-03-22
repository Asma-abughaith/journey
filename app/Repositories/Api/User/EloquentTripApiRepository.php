<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\TagsResource;
use App\Http\Resources\TripDetailsResource;
use App\Http\Resources\TripResource;
use App\Interfaces\Gateways\Api\User\TripApiRepositoryInterface;
use App\Models\Reviewable;
use App\Models\Tag;
use App\Models\Trip;
use App\Models\UsersTrip;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class EloquentTripApiRepository implements TripApiRepositoryInterface
{

    public function trips()
    {
        $trips = Trip::all();
        return TripResource::collection($trips);
    }

    public function privateTrips()
    {
        $trips = Trip::where('user_id', Auth::guard('api')->user()->id)->get();
        return TripResource::collection($trips);
    }

    public function tripDetails($trip_id)
    {
        $trips = Trip::find($trip_id);
        return new TripDetailsResource($trips);
    }

    public function tags()
    {
        $tags = Tag::get();
        return TagsResource::collection($tags);
    }

    public function createTrip($request)
    {
        $tags = json_decode($request->tags);
        $age_range = json_encode(['min' => $request->age_min, 'max' => $request->age_max]);
        $date_time = Carbon::createFromFormat('Y-m-d H:i:s', $request->date . ' ' . $request->time);

        $eloquentTrip = new Trip();
        $eloquentTrip->user_id = Auth::guard('api')->user()->id;
        $eloquentTrip->place_id = $request->place_id;
        $eloquentTrip->name = $request->name;
        $eloquentTrip->description = $request->description;
        $eloquentTrip->cost = $request->cost;
        $eloquentTrip->age_range = $age_range;
        $eloquentTrip->sex = $request->gender;
        $eloquentTrip->date_time = $date_time;
        $eloquentTrip->attendance_number = $request->attendance_number;
        $eloquentTrip->save();
        $eloquentTrip->tags()->attach($tags);
        return new TripResource($eloquentTrip);
    }

    public function joinTrip($trip_id)
    {
        $checkUser = $this->checkIfTheUserHasAlreadyJoined(Auth::guard('api')->user()->id, $trip_id);
        if ($checkUser) {
            $eloquentJoinTrip = new UsersTrip();
            $eloquentJoinTrip->user_id = Auth::guard('api')->user()->id;
            $eloquentJoinTrip->trip_id = $trip_id;
            $eloquentJoinTrip->save();
        }
    }

    public function cancelJoinTrip($trip_id)
    {
        UsersTrip::where('trip_id', $trip_id)->where('user_id', Auth::guard('api')->user()->id)->update(['status' => '3']);
    }

    public function checkIfTheUserHasAlreadyJoined($user_id, $trip_id)
    {
        $checkUser = UsersTrip::where('trip_id', $trip_id)->where('user_id', $user_id)->where('status', '3')->first();
        if ($checkUser) {
            $checkUser->status = '0';
            $checkUser->save();
            return false;
        }
        return true;
    }

    public function changeStatus($request)
    {
        $status = $request->status == 'accept' ? '1' : '2';
        $userTrip = UsersTrip::where('user_id', $request->user_id)->where('trip_id', $request->trip_id)->first();
        $userTrip->status = $status;
        $userTrip->save();
    }

    public function favorite($id)
    {
        $user = Auth::guard('api')->user();
        $user->favoriteTrip()->attach($id);
    }

    public function deleteFavorite($id)
    {
        $user = Auth::guard('api')->user();
        $user->favoriteTrip()->detach($id);
    }

    public function addReview($data)
    {
        $user = Auth::guard('api')->user();
        $user->reviewTrip()->attach($data['trip_id'], [
            'rating' => $data['rating'],
            'comment' => $data['comment']
        ]);
    }

    public function updateReview($data)
    {
        $user = Auth::guard('api')->user();
        $user->reviewTrip()->sync([$data['trip_id'] => [
            'rating' => $data['rating'],
            'comment' => $data['comment']
        ]]);
    }

    public function deleteReview($id)
    {
        $user = Auth::guard('api')->user();
        $user->reviewTrip()->detach($id);
    }

    public function allReviews($id)
    {
        //you should first make like for reviews and then retrieve it
    }

    public function reviewsLike($request)
    {
        $review = Reviewable::find($request->review_id);
        $status = $request->status == "like" ? '1' : '0';

        $existingLike = $review->like()->where('user_id', Auth::guard('api')->user()->id)->first();

        if ($existingLike) {
            if ($existingLike->pivot->status != $status) {
                $review->like()->updateExistingPivot(Auth::guard('api')->user()->id, ['status' => $status]);
            } else {
                $review->like()->detach(Auth::guard('api')->user()->id);
            }
        } else {
            $review->like()->attach(Auth::guard('api')->user()->id, ['status' => $status]);
        }
    }
}