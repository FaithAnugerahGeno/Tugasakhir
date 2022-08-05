<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class JobController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  // private $myarray = array();

  public function index(Request $request)
  {
    $client = new Client();

    $keyword = $request->input('keyword');
    $location = $request->input('location');
    $id = $request->input('id');

    $url =  'https://glints.com/id/opportunities/jobs/explore?keyword=' . $keyword . '&country=ID&locationName=' . $location . '$page=' . $id;
    $page = $client->request('GET', $url);

    $myarray = array();
    $page->filter('.JobCardsc__JobcardContainer-sc-1f9hdu8-0')->each(function ($item) use (&$myarray, $page) {
      $filtered = [
        'img' => $item->filter('img')->attr('src'),
        'link' => $item->filter('.CompactOpportunityCardsc__CardAnchorWrapper-sc-1y4v110-18')->attr('href'),
        // 'status' => $item->filter('.CheckMarkHotJobBadgesc__CheckMarkHotJobBadgeContainer-sc-9hcb5a-0')->text(),
        'title' => $item->filter('.CompactOpportunityCardsc__JobTitle-sc-1y4v110-7')->text(),
        'perusahaan' => $item->filter('.CompactOpportunityCardsc__CompanyLink-sc-1y4v110-8')->text(),
        'lokasi' => $item->filter('.CompactOpportunityCardsc__OpportunityInfo-sc-1y4v110-13')->eq(0)->text(),
        'gaji' => $item->filter('.CompactOpportunityCardsc__OpportunityInfo-sc-1y4v110-13')->eq(1)->text(),
        'pengalaman' => $item->filter('.CompactOpportunityCardsc__OpportunityInfo-sc-1y4v110-13')->eq(2)->text(),
        // 'activity' => $item->filter('.CompactOpportunityCardsc__OpportunityMeta-sc-1y4v110-14 > .CompactOpportunityCardsc__UpdatedAtMessage-sc-1y4v110-17')->text(),
      ];
      array_push($myarray, $filtered);
    });

    // echo "<pre>";
    // print_r($page);

    $data['data'] = array_slice($myarray, 0, 20);
    // return $data;
    return view('job', $data);
  }
}
