<?php


namespace App\Http\Controllers;


use App\Document;
use App\MyConst;
use App\ReviewRequest;
use App\User;
use App\ViewsWeb;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{

    public function index(Request $request) {
        if (!$request->has('id')) return response(['status' => MyConst::BAD_REQUEST]);
        $doc = Document::where(['id_avt' => $request->post('id')])->first();
        if (is_null($doc))
            return response(['status' => MyConst::NO_SUCH_FILE]);
        $doc->addView($request->ip());
        return response(['status' => MyConst::OK, 'document' => $doc->clear()]);
    }

    public function upload(Request $request) {
        if (!$request->hasfile('file'))
            return response(['status' => MyConst::BAD_REQUEST]);

        $date_path = "data/" . date('Y-m', time());
        $path = $request->file('file')->store($date_path);
        $id_file = strtoupper(Str::random(9));
        $login = Auth::user()->login;
        $ip = $request->ip();
        $comment = $request->has('comment') ? $request->post('comment') : '';


        $doc = new Document();
        $doc->id_avt = $id_file;
        $doc->trec = $path;
        $doc->login = $login;
        $doc->IP = $ip;
        $doc->Comment_file = is_null($comment) ? '' : $comment;


        if ($doc->save()) {
            if (!is_null($request->post('recipient'))) {
                $review = new ReviewRequest();
                $review->id_doc = $doc->id;
                $review->id_sender = Auth::user()->id;
                $review->id_recipient = $request->post('recipient');
                $review->save();
            }
            return response(['status' => MyConst::OK, 'id' => $id_file]);
        } else {
            return response(['status' => MyConst::SAVE_ERROR]);
        }

    }

//    public function getReview() {
////        return
//    }
    public function getNewReview() {
        $reviews = ReviewRequest::where([
            'id_recipient' => Auth::user()->id,
            'id_status' => '1'])
            ->select('all_file.id_avt')
            ->join('all_file', 'all_file.id', '=', 'review_requests.id_doc')
            ->get()
            ->all();

        $reviews = array_map(function ($item) {
            return $item['id_avt'];
        }, $reviews);

        return response()->json(['status' => MyConst::OK, 'reviews' => $reviews]);
    }

    public function file($name) {
        $doc = Document::where('id_avt', '=', $name)->first();
        $path = $doc['trec'];
        if (Storage::disk('local')->exists($path))
        {
            return response()->file(storage_path('app/' . $doc['trec']));
        }
        else
            return redirect('not found', 404);
    }

    public function getHistory(Request $request) {
        $user = Auth::user();
        if (is_null($user)) return response(['status' => MyConst::UNAUTHORIZED]);

        $views = DB::table('request_web')
            ->leftJoin('peer_review', 'request_web.id_request', '=', 'peer_review.id_request')
            ->join('all_file', 'request_web.id_request', '=', 'all_file.id_avt')
            ->join('users', 'users.login', '=', 'all_file.login')
            ->orderBy('request_web.DateTimeSearch', 'desc');

        $views->where('request_web.login', '=', $user->login);
        $views = self::select($views);
        $views = self::filter($views, $request->post('range'), $request->post('like'));

        return response( $views->get() );
    }

    public function searchDocs(Request $request) {
        $views = DB::table('all_file')
            ->leftJoin('peer_review', 'all_file.id_avt', '=', 'peer_review.id_request')
            ->join('users', 'users.login', '=', 'all_file.login')
            ->orderBy('all_file.DateTimeUpld', 'desc');

        $views = self::select($views);
        $views = self::filter($views, $request->post('range'), $request->post('like'));

        return response( $views->get() );
    }

    public function getMyDocs(Request $request) {
        $user = Auth::user();
        if (is_null($user)) return response(['status' => MyConst::UNAUTHORIZED]);

        $views = DB::table('all_file')
            ->leftJoin('peer_review', 'all_file.id_avt', '=', 'peer_review.id_request')
            ->join('users', 'users.login', '=', 'all_file.login')
            ->orderBy('all_file.DateTimeUpld', 'desc');

        $views->where('users.login', '=', $user->login);
        $views = self::select($views);
        $views = self::filter($views, $request->post('range'), $request->post('like'));

        return response( $views->get() );
    }

    public function getDocInfo(Request $request) {
        $user = Auth::user();
        if (!$request->post('id')) return response(['status' => MyConst::BAD_REQUEST]);

        $file = DB::table('all_file')
            ->join('users', 'users.login', '=', 'all_file.login')
            ->where('all_file.id_avt', '=', $request->post('id'))
            ->select([
                'all_file.id_avt as id',
                'all_file.Comment_file as comment',
                'all_file.DateTimeUpld as date',
                'all_file.login as creator_login',
                'users.FIO',
                'users.sFIO',
            ])
            ->limit(1)
            ->get();


        $review = DB::table('peer_review')
            ->where('peer_review.id_request', '=', $request->post('id'))
            ->join('users', 'users.login', '=', 'peer_review.login')
            ->select([
                'essence',
                'comment',
                'DateTimeComment as date',
                'users.login',
                'users.FIO',
                'users.sFIO',
            ])
            ->get();

        return response()->json([
            $file,
            'review' => is_null($review) ? [] : $review,
        ]);
    }

    public function getRequests(Request $request) {
        $user = Auth::user();
        if (is_null($user)) return response(['status' => MyConst::UNAUTHORIZED]);

        $views = DB::table('review_requests')
            ->leftJoin('all_file', 'all_file.id', '=', 'review_requests.id_doc')
            ->leftJoin('peer_review', 'all_file.id_avt', '=', 'peer_review.id_request')
            ->join('users', 'users.login', '=', 'all_file.login')
            ->join('review_request_status', 'review_request_status.id', '=', 'review_requests.id_status')
            ->orderBy('id_status', 'asc')
            ->orderBy('review_requests.create_date', 'desc');

        $views->where('id_recipient', '=', $user->id);
        $views = self::select($views);
        $views->addSelect('review_request_status.id as status_id');
        $views->addSelect('review_request_status.name as status_name');
        $views = self::filter($views, $request->post('range'), $request->post('like'));
        if ($request->post('status') != 0) {
            $views->where('id_status', '=', $request->post('status'));
        }

        return response( $views->get() );
    }

    public function filter($query, $range, $like) : Builder {
        if ($range != null)
        {
            $start = (int)round((int)$range['start'] / 1000);
            $end = (int)round((int)$range['end'] / 1000);
            $start = date('Y-m-d', $start);
            $end = date('Y-m-d', $end);
            $query->whereBetween('all_file.DateTimeUpld', [$start, $end]);
        }

        $query->where(function ($query) use ($like) {
            $query->where('users.FIO', 'LIKE', '%' . $like . '%')
                ->orWhere('users.sFIO', 'LIKE', '%' . $like . '%')
                ->orWhere('all_file.id_avt', 'LIKE', '%' . $like . '%')
                ->orWhere('all_file.Comment_file', 'LIKE', '%' . $like . '%')
                ->orWhere('peer_review.essence', 'LIKE', '%' . $like . '%');
        });

        return $query;
    }

    public function select($query): Builder {
        return $query->select(
                'all_file.id_avt as id',
                'users.FIO as fio',
                'users.sFIO as sfio',
                'all_file.DateTimeUpld as date',
                'all_file.Comment_file as comment',
                'peer_review.essence'
            );
    }
}
