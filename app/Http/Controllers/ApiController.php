<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Employee;
//use App\Http\Requests\StoreRequest;

class ApiController extends Controller
{
    //listing the records from table
    public function index()
    {
        $records = Employee::paginate(10);
        return response()->json($records);
    }

    // for creating a record
    public function store(Request $request)
    {
        $validator= $this->validate($request, [
    
            'Emp_name' => 'required|string',
            'Emp_email' => 'required|email|unique:employees',
            'Emp_no' => 'required|digits:5|unique:employees',
            'Emp_phone' => 'required|regex:/^[0-9]{10}$/',
        ]);

        if($validator){
        $record = new Employee();
         $record->Emp_name=$request->Emp_name;
         $record->Emp_email=$request->Emp_email;
         $record->Emp_no=$request->Emp_no;
         $record->Emp_phone=$request->Emp_phone;
         $record->save();


        return response()->json([
            'message' => 'Record created successfully',
            'data' => $record
        ], 201);
    }
    }

    // for updating the particular record 
    public function update(Request $request, $id)
    {
        $record = Employee::find($id);
        $validator= $this->validate($request, [
    
            'Emp_name' => 'required|string',
            'Emp_email' => 'required|email',
            'Emp_no' => 'required|digits:5',
            'Emp_phone' => 'required|regex:/^[0-9]{10}$/',
        ]);

        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        //$record->update($request->all());
        If($validator){
        $record->Emp_name=$request->Emp_name;
         $record->Emp_email=$request->Emp_email;
         $record->Emp_no=$request->Emp_no;
         $record->Emp_phone=$request->Emp_phone;
         $record->save();
         return response()->json([
            'message' => 'Record updated successfully',
            'data' => $record
        ], 200);
    }
    }

    //for showing particular record 
    public function show($id)
    {
        $record = Employee::find($id);

        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return response()->json($record);
    }

    //Deleting the particular $id
    public function destroy($id)
    {
        $record = Employee::find($id);
 
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $record->delete();

        return response()->json(['message' => 'Record deleted Successfully', 'deleted_id' => $id]);
    }
}
