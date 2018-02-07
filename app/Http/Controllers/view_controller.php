<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
Use Illuminate\Support\Facades\Input;
use File;
Use App\Image;
Use App\Announcement;
Use App\Circular;
Use App\Member;
Use App\Message;

class view_controller extends Controller
{
    public function home(){

// ------------------- Announcements -------------------
        $updates = Announcement::where('status', 1)->latest()->get();
        foreach($updates as $singleUpdate)
        $update[] = $singleUpdate;



// ------------------- Members -------------------
        $committemembers = Member::where([
            ['status', '=', '1'],
                ['type', '=', '1'],
                ])->get();
        foreach($committemembers as $committemember)
                $committe[] = $committemember;

        $focalmembers = Member::where([
            ['status', '=', '1'],
                ['type', '=', '2'],
                ])->get();
        foreach($focalmembers as $focalmember)
                $focal[] = $focalmember;



// ------------------- Images -------------------
        $achievements = Image::where([
            ['status', '=', '1'],
                ['type', '=', '1'],
                ])->latest()->get();
        foreach($achievements as $singleAchievement)
                $achievement[] = $singleAchievement;
        $projects = Image::where([
            ['status', '=', '1'],
                ['type', '=', '2'],
                ])->latest()->get();
        foreach($projects as $singleProject)
                $project[] = $singleProject;
        $gallery = Image::where([
            ['status', '=', '1'],
                ['type', '=', '3'],
                ])->latest()->get();
        foreach($gallery as $singleGallery)
                $galleryImage[] = $singleGallery;
        $slides = Image::where([
            ['status', '=', '1'],
                ['type', '=', '4'],
                ])->latest()->get();
        foreach($slides as $singleSlide)
                $slider[] = $singleSlide;


// ------------------- Circulars -------------------
        $circulars = Circular::where('status', 1)->latest()->get();
        foreach($circulars as $singleCircular)
        $circular[] = $singleCircular;
       return view('siteView.pechsHome', compact('update', 'committe', 'focal', 'circular', 'achievement', 'project', 'galleryImage', 'slider'));
    }

    public function viewAnnouncementDetails($announcementId)
    {
      $updates = Announcement::where('status', 1)->latest()->get();
      foreach($updates as $singleUpdate)
      $update[] = $singleUpdate;

      $announcement = Announcement::find($announcementId);
      return view('siteView.announcement', compact('announcement', 'update'));
    }

    // ***************** Add Visitor Message *****************
public function contactUs(Request $req){
  $message = new Message();
  $message->name = $req->name;
  $message->senderEmail = $req->email;
  $message->recipientEmail = '0'; // 0 = site admin
  $message->message = $req->message;
  $message->status = '0';
  $message->save();
  // Mail::send(new sendMail());
  return redirect()->action('view_controller@home')->with('message', 'Admin will soon get in contact with you.');
}
}
