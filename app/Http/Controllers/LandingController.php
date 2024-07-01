<?php

namespace App\Http\Controllers;

use App\Notifications\StatusNotification;
use Exception;
use Carbon\Carbon;
use App\Models\Landing;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;



class LandingController extends Controller
{
    public function LendingPage()
    {
        return view('pages.lending-page');
    }

    public function BookingPage()
    {
        return view('pages.booking-page');
    }

    public function ListLandings()
    {
        try
        {
            $landings = Landing::with(['user', 'book'])->get();
            return ResponseHelper::Out('Success', $landings, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('Failed', $exception->getMessage(), 401);
        }
    }

    public function CreateLanding(Request $request)
    {
        try
        {

            $user_id    = $request->header('id');
            $book_id    = $request->book_id;
            $quantity   = $request->quantity;

            $validatedData = $request->validate([
                'book_id'   => 'required|exists:books,id',
                // 'status'    => 'required|in:pending,lent,returned,overdue',
            ]);

            $landing = Landing::create([
                'user_id'   => $user_id,
                'book_id'   => $book_id,
                'quantity'  => $quantity
                // 'status'    => $validatedData['status'],
            ]);

            return ResponseHelper::Out('Landing created successfully', $landing, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('Landing creation failed', $exception->getMessage(), 401);
        }
    }

    public function GetLandingById(Request $request)
    {
        try
        {
            $landing_id = $request->landing_id;
            $landings = Landing::with(['user', 'book'])->findOrFail($landing_id);

            return ResponseHelper::Out('success', $landings, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('failed', $exception->getMessage(), 401);
        }
    }

    // public function UpdateLanding(Request $request)
    // {
    //     try
    //     {
    //         $landing_id = $request->landing_id;

    //         // Validate input data with conditional logic for loaned_on
    //         $validatedData = $request->validate([
    //             'status'    => 'required|in:pending,lent,returned,overdue',
    //             'due_date'  => 'required|date'
    //         ]);

    //         // Set loaned_on to current date and time if the status is 'lent'
    //         $validatedData['loaned_on'] = $validatedData['status'] === 'lent' ? now() : null;

    //         $validatedData['due_date'] = Carbon::parse($validatedData['due_date']);


    //         $landing = Landing::where('id', $landing_id)->update([
    //             'book_id'   => $request->input('book_id'),
    //             'status'    => $validatedData['status'],
    //             'loaned_on' => $validatedData['loaned_on'],
    //             'due_date'  => $validatedData['due_date']
    //         ]);

    //         if ($landing->isDirty('status')) { // Check if status has changed
    //             $notification = new LoanStatusNotification($landing);
    //             $landing->user->notify($notification); // Assuming User has notifications method
    //         }

    //         return ResponseHelper::Out('Landing updated successfully', $landings, 200);
    //     }
    //     catch(Exception $exception)
    //     {
    //         return ResponseHelper::Out('Landing update failed', $exception->getMessage(), 401);
    //     }
    // }


    public function UpdateLanding(Request $request)
    {
        try {
            $landing_id = $request->landing_id;

            $validatedData = $request->validate([
                'status'    => 'required|in:pending,lent,returned,overdue',
                'due_date'  => 'required|date'
            ]);

            $validatedData['loaned_on'] = $validatedData['status'] === 'lent' ? now() : null;

            $validatedData['due_date'] = Carbon::parse($validatedData['due_date']);

            $landing = Landing::findOrFail($landing_id);

            $landing->update($validatedData);

            return ResponseHelper::Out('Landing updated successfully', $landing, 200);
        } catch (Exception $exception) {
            return ResponseHelper::Out('Landing update failed', $exception->getMessage(), 401);
        }
    }


    public function DeleteLanding(Request $request)
    {
        try
        {
            $landing_id = $request->landing_id;
            $landing = Landing::findOrFail($landing_id);
            $landing->delete();

            return ResponseHelper::Out('Landing deleted successfully', $landing, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('Landing deletion failed', $exception->getMessage(), 401);
        }
    }

    public function BookingList(Request $request)
    {
        try
        {
            $userID = $request->header('id');
            $bookingList = Landing::where('user_id', $userID)->with('book')->get();
            return ResponseHelper::Out('success', $bookingList, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('failed', $exception->getMessage(), 401);
        }
    }
}
