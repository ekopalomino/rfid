<?php

namespace iteos\Http\Controllers\API;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\TagDeviceAudit;
use Validator;
use iteos\Http\Controllers\API\BaseController as BaseController;
use iteos\Http\Resources\AuditResource as AuditResource;

class AuditController extends BaseController
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$ids = $request->product_id;
        $branch = $request->branch_id;
        $location = $request->location_id;*/

        /* $input = $request->all();
        $validator = Validator::make($input, [
            'product_id' => 'required',
            'branch_id' => 'required',
            'location_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } */
        foreach($request->data as $data) {
            
            $audit = TagDeviceAudit::create([
                'product_id' => $data['product_id'],
                'audit_branch' => $data['branch'],
                'audit_location' => $data['location']
            ]);
        }
       /* foreach($ids as $index=>$id) {
            $audit = TagDeviceAudit::create([
                'product_id' => $id,
                'branch_id' => $branch[$index],
                'location_id' => $location[$index]
            ]);
        } */
        /*$count = count($request->input('product_id'));
        for ($i=0; $i<$count; $i++){
            $data[] = array('product_id' => $request->input('product_id')[$i], 'branch_id' => $request->input('branch_id')[$i]);
        }
        /*return $data;*/
   
        return $this->sendResponse(new AuditResource($audit), 'Audit Data Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
