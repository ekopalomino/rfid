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
    public function store(Request $request)
    {
        $ids = Uuid::uuid4();
        foreach($request->data as $data) {
            
           /*  $audit = TagDeviceAudit::firstOrCreate(
                ['sap_code' => $data('sap_code'),'push_id' => '1'],
                ['audit_branch' => $data('branch'),'audit_location' => $data('location')]
            ); */
            $validator = Validator::make($data, [
                'product_id' => 'required',
                'branch' => 'required',
                'location' => 'required'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            

            $audit = TagDeviceAudit::firstOrCreate([
                'push_id' => $ids,
                /*'sap_code' => rtrim($data['product_id'],"00"),*/
                'sap_code' => $data['product_id'],
                'audit_branch' => $data['branch'],
                'audit_location' => $data['location']
            ]);
        }
       
        return $this->sendResponse(new AuditResource($audit), 'Audit Data Created Successfully');
    }
}
