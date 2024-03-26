<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Report\SendTaskReportRequest;
use App\Jobs\SendReportPdf;
use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function __construct(protected ReportService $report_service)
    {
    }

    public function task_report(SendTaskReportRequest $request)
    {
        try {
            $tasks = $this->report_service->find_all_tasks($request);
            $data = [
                'tasks' => $tasks,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ];
            $pdf = Pdf::loadView('pdf.report_task', $data);
            $data = [
                'email' => $request->email,
                'subject' => 'Report task',
                'pdf' => $pdf
            ];

            $email_template = 'email-template.report';

            SendReportPdf::dispatch($data, $email_template);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
