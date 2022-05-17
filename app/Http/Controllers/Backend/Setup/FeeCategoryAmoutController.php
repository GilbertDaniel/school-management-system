<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategoryAmount;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;

class FeeCategoryAmoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allData'] = FeeCategoryAmount::select(
            'fee_category_id',
            DB::raw("SUM(amount) as fee_amount_total")
        )->groupBy('fee_category_id')->get();
    	return view('backend.setup.fee_amount.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['fee_categories'] = FeeCategory::all();
    	$data['classes'] = StudentClass::all();
    	return view('backend.setup.fee_amount.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $countClass = count($request->class_id);
    	if ($countClass !=NULL) {
    		for ($i=0; $i <$countClass ; $i++) {
    			$fee_amount = new FeeCategoryAmount();
    			$fee_amount->fee_category_id = $request->fee_category_id;
    			$fee_amount->class_id = $request->class_id[$i];
    			$fee_amount->amount = $request->amount[$i];
    			$fee_amount->save();

    		} // End For Loop
    	}// End If Condition

    	$notification = array(
    		'message' => 'Fee Amount Inserted Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('fee.amount.view')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id',$id)->orderBy('class_id','asc')->get();
        return view('backend.setup.fee_amount.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$id)->orderBy('class_id','asc')->get();
    	// dd($data['editData']->toArray());
    	$data['fee_categories'] = FeeCategory::all();
    	$data['classes'] = StudentClass::all();
    	return view('backend.setup.fee_amount.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->class_id == NULL) {

            $notification = array(
                'message' => 'Sorry You do not select any class amount',
                'alert-type' => 'error'
            );

            return redirect()->route('fee.amount.edit',$id)->with($notification);

            }else{

                $countClass = count($request->class_id);
                FeeCategoryAmount::where('fee_category_id',$id)->delete();
                for ($i=0; $i <$countClass ; $i++) {
                    $fee_amount = new FeeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
                    $fee_amount->save();

                } // End For Loop

            }// end Else

           $notification = array(
                'message' => 'Data Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('fee.amount.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FeeCategoryAmount::where('fee_category_id',$id)->delete();
        $notification = array(
    		'message' => 'Fee Category Deleted Successfully',
    		'alert-type' => 'info'
    	);

        return redirect()->route('fee.amount.view')->with($notification);

    }
}
