<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pwb_Ticket_Status;

class TicketStatusController extends Controller
{

    public function __construct() {}

    /**
     * @OA\Get(
     *     path="/api/ticket/statuses",
     *     summary="Get a list of all the ticket statuses",
     *     tags={"Ticket Status"},
     *     security={{"passport":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function index()
    {
        $statuses = Pwb_Ticket_Status::getInstance();
        return $statuses->getAll();
    }

    /**
     * @OA\Get(
     *     path="/api/ticket/statuses/{value}",
     *     summary="Get details of a ticket status",
     *     tags={"Ticket Status"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *          name="value",
     *          in="path",
     *          required=true,
     *          example=7
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function show($value)
    {
        $statuses = Pwb_Ticket_Status::getInstance();
        return $statuses->find($value);
    }

}
