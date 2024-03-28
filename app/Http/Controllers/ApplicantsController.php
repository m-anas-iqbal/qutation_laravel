<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Applicant;
use App\Traits\AttachmentTrait;

class ApplicantsController extends Controller
{
    use AttachmentTrait;
    public function index(Request $request)
    {
        $data['from'] = $request->from;
        $data['to'] = $request->to;

        return view('admin.applicants.index', $data);
    }

    public function show($slug)
    {
        $applicant = Applicant::join('posts', 'posts.id', '=', 'applicants.post_id')
            ->join('departments', 'departments.id', '=', 'posts.department_id')
            ->join('attachments', 'attachments.id', '=', 'applicants.attachment_id')
            ->select('departments.name as department', 'posts.title', 'posts.state', 'posts.positions', 'applicants.*', 'attachments.attachment')
            ->where('applicants.slug', $slug)
            ->first();

        if ($applicant->status == 1) {
            $applicant->update(['status' => 2]);
        }
        $data['applicant'] = $applicant;

        return view('admin.applicants.show', $data);
    }

    public function update(Request $request, $id)
    {
        return 'What to do? here?';
        Applicant::where('id', $id)->update(['status' => $request->status]);

        return back()->with('success', 'Status updated successfully.');
    }
    
    public function destroy($id)
    {
        $applicant = Applicant::find($id);
        $this->removeAttachment($applicant->attachment_id);
        $applicant->delete();

        return back()->with('success', 'Applicant deleted successfully.');
    }

    public function applicantsList(Request $request)
    {
        $columns = array('id', 'department', 'job', 'name', 'email', 'phone', 'city', 'resume');

        $totalApplicants = DB::table('applicants')->count();
        $totalFiltered = $totalApplicants;
        if ($request->input('length') == -1) {
            $limit =  $totalApplicants;
        } else {
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $applicants = DB::table('applicants')
                ->join('posts', 'posts.id', '=', 'applicants.post_id')
                ->join('departments', 'departments.id', '=', 'posts.department_id')
                ->join('attachments', 'attachments.id', '=', 'applicants.attachment_id')
                ->select('departments.name as department', 'posts.title', 'posts.positions', 'applicants.id', 'applicants.name', 'applicants.email', 'applicants.phone', 'applicants.city', 'applicants.slug', 'attachments.attachment', 'applicants.created_at')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $applicants = DB::table('applicants')
                ->join('posts', 'posts.id', '=', 'applicants.post_id')
                ->join('departments', 'departments.id', '=', 'posts.department_id')
                ->join('attachments', 'attachments.id', '=', 'applicants.attachment_id')
                ->select('departments.name as department', 'posts.title', 'posts.positions', 'applicants.id', 'applicants.name', 'applicants.email', 'applicants.phone', 'applicants.city', 'applicants.slug', 'attachments.attachment', 'applicants.created_at')
                ->where('departments.name', 'LIKE', "%{$search}%")
                ->orWhere('posts.title', 'LIKE', "%{$search}%")
                ->orWhere('applicants.name', 'LIKE', "%{$search}%")
                ->orWhere('applicants.email', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $applicants->count();
        }

        $data = array();
        if (!empty($applicants)) {
            foreach ($applicants as $applicant) {
                $nestedData['id'] = $applicant->id;
                $nestedData['department'] = $applicant->department;
                $nestedData['job'] = $applicant->title;
                $nestedData['name'] = $applicant->name;
                $nestedData['email'] = $applicant->email;
                $nestedData['phone'] = $applicant->phone;
                $nestedData['city'] = $applicant->city;
                $nestedData['resume'] = '<a class="pl-4" href="' . asset('uploads/' . $applicant->attachment) . '"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><path d="M11.5,3H13a.5.5,0,0,1,.5.5v7a.5.5,0,0,1-.5.5H1a.5.5,0,0,1-.5-.5v-7A.5.5,0,0,1,1,3H2.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path><line x1="7" y1="11" x2="7" y2="13.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><line x1="5" y1="13.5" x2="9" y2="13.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><line x1="7" y1="0.5" x2="7" y2="6.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><polyline points="5 4.5 7 6.5 9 4.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline></g></svg></a>';
                $nestedData['date'] = date('m-d-Y', strtotime($applicant->created_at));
                $nestedData['action'] = '<a href="#" data-toggle="modal" data-target="#delete-applicant" data-action="' . route('applicants.destroy', $applicant->id) . '" class="delete-applicant pl-3"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalApplicants),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }
}
