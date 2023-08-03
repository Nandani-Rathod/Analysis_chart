<?php

namespace App\Http\Controllers;

use App\Models\CSVData;
use Illuminate\Http\Request;
use League\Csv\Reader;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CSVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CSVData  $cSVData
     * @return \Illuminate\Http\Response
     */
    public function show(CSVData $cSVData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CSVData  $cSVData
     * @return \Illuminate\Http\Response
     */
    public function edit(CSVData $cSVData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CSVData  $cSVData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CSVData $cSVData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CSVData  $cSVData
     * @return \Illuminate\Http\Response
     */
    public function destroy(CSVData $cSVData)
    {
        //
    }
    public function showUploadForm()
    {
        return view('upload_form');
    }
    
public function processCSV(Request $request)
{
    // Validate the uploaded file
    if ($request->hasFile('csv_file') && $request->file('csv_file')->isValid()) {
        // Store the uploaded file in the 'csv_files' directory with a unique name
        $csvFilePath = $request->file('csv_file')->storeAs('csv_files', $request->file('csv_file')->getClientOriginalName());

        // Verify if the file exists
        if (Storage::exists($csvFilePath)) {
            // Process the CSV file and store its data in the database
            $csv = Reader::createFromPath( public_path($csvFilePath), 'r');
            $csv->setHeaderOffset(0);
            $records = $csv->getRecords();

            foreach ($records as $record) {
                // Convert the date and time to a standard format
                $dateTime = Carbon::createFromFormat('n/j/y g:i A', $record['Date'] . ' ' . $record['Time']);

                $data = [
                    'date' => $dateTime, // Use the concatenated date and time as a timestamp
                    'users' => $record['Users'],
                    // Add other columns as needed
                    // 'value' => $record['Value'],
                    // ...
                ];

                // Assuming your CSVData model is properly defined and has the $fillable property set
                CSVData::create($data);
            }
            return redirect()->back()->with('success', 'CSV file uploaded and data stored successfully!');
        } else {
            // Handle file not found error
            return redirect()->back()->with('error', 'Error processing the CSV file. File not found.');
        }
    } else {
        // Handle file upload failure
        return redirect()->back()->with('error', 'Error uploading the CSV file. Please try again.');
    }
}
}
