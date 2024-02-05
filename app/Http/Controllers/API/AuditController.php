<?php

namespace iteos\Http\Controllers\API;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\TagDeviceAudit;
use Ramsey\Uuid\Uuid;
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
        $ids = Uuid::uuid4();
        foreach($request->data as $data) {
            
           /*  $audit = TagDeviceAudit::firstOrCreate(
                ['sap_code' => $data('sap_code'),'push_id' => '1'],
                ['audit_branch' => $data('branch'),'audit_location' => $data('location')]
            ); */
            $audit = TagDeviceAudit::firstOrCreate([
                'push_id' => $ids,
                'sap_code' => $data['sap_code'],
                'audit_branch' => $data['branch'],
                'audit_location' => $data['location']
            ]);
        }
       
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
