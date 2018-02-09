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
Use Mail;
Use App\Mail\sendMail;
Use App\Mail\reply;
Use Hash;

class upload_controller extends Controller
{

      public function __construct()
    {
        $this->middleware('auth:admin');
    }


  public function index()
  {
    return view('admin.addContent');
  }

  public function profile()
  {
    $adminDetails = Auth::user();
    return view('admin.profile', compact('adminDetails'));
  }

  public function saveProfile(Request $req, $adminId){
    $adminDetails = Auth::user()->find($adminId);
if($req->currentPassword){
    if(Hash::check($req->currentPassword, $adminDetails->password)){
      // check if password greater than 05 characters
    $this->validate($req, [
    'newPassword' => 'min:6',
]);
    $adminDetails->password = bcrypt($req->newPassword);
  }
  else
  return redirect::back()->with('error', 'password not correct');
}
  $adminDetails->name = $req->name;
  $adminDetails->email = $req->email;
  $adminDetails->save();
  return redirect::back()->with('message', 'Profile Edit Successful');
}
    //  ******************************************
    //             Announcement Functions
    //  ******************************************

    // Possible Status(int) Forms
// 0 -> not displayed on site
// 1 -> displayed on site

// Possible fileType(int) Forms
// 0 -> no file image attatched
// 1 -> only image attatched
// 2 -> ony file attatched
// 3 -> both file and image attatched

// ***************** Make Announcement *****************
    public function makeAnnouncement(Request $req){

      // for file save
      if($req->file('announcementFile')){
       Storage::put('public/myAssets/announcement', $req->announcementFile);
}

      // for image save
      if($req->file('imageFile')){
       Storage::put('public/myAssets/announcement', $req->imageFile);
}


$saveAnnouncement = new Announcement;

if($req->file('imageFile'))
{
  $saveAnnouncement->filetype = "1"; // because img uploaded
  $saveAnnouncement->imgpath = $req->imageFile->hashName();
}

if($req->file('announcementFile'))
{
  $saveAnnouncement->filetype = "2"; // because file uploaded
  $saveAnnouncement->filepath = $req->announcementFile->hashName();
}

if($req->file('announcementFile') && Input::hasFile('imageFile'))
{
  $saveAnnouncement->filetype = "3"; // because both files uploaded
}

if(!$req->file('announcementFile') && !$req->file('imageFile'))
{
  $saveAnnouncement->filetype = "0"; // because no file uploaded
}
        $saveAnnouncement->title = $req->announcementTitle;
        $saveAnnouncement->description = $req->announcementDetails;
        $saveAnnouncement->status = "1";
        $saveAnnouncement->save();
        return redirect::back()->with('message', 'Announcement Successful');
    }

// ***************** View All Announcements *****************
     public function viewAllAnnouncements(){
         $enabledAnnouncements = Announcement::where('status', 1)->latest()->paginate(10, ['*'], 'enabledTable');
         $disabledAnnouncements = Announcement::where('status', 0)->latest()->paginate(10, ['*'], 'disabledTable');

         return view('admin.announcement.viewAllAnnouncements',compact('enabledAnnouncements', 'disabledAnnouncements'));
        }

// ***************** View/Edit Specific Announcement *****************
        public function editAnnouncement($announcementId){
             $announcement = Announcement::find($announcementId);

         return view('admin.announcement.viewEditAnnouncement',compact('announcement'));
        }

// ***************** Save Edit Specific Announcement *****************
        public function saveEditAnnouncement(Request $req, $announcementId){
             $saveAnnouncement = Announcement::find($announcementId);

            // for file save
      if($req->file('announcementFile'))
       Storage::put('public/myAssets/announcement', $req->announcementFile);

      // for image save
      if($req->file('imageFile'))
       Storage::put('public/myAssets/announcement', $req->imageFile);

// no previous files present
if($saveAnnouncement->filetype == '0')
{
  if($req->file('imageFile'))
  {
    $saveAnnouncement->filetype = "1"; // because img uploaded
    $saveAnnouncement->imgpath = $req->imageFile->hashName();
  }

  if($req->file('announcementFile'))
  {
    $saveAnnouncement->filetype = "2"; // because file uploaded
    $saveAnnouncement->filepath = $req->announcementFile->hashName();
  }

  if($req->file('announcementFile') && Input::hasFile('imageFile'))
  {
    $saveAnnouncement->filetype = "3"; // because both files uploaded
  }

  if(!Input::hasFile('announcementFile') && !Input::hasFile('imageFile'))
  {
    $saveAnnouncement->filetype = "0"; // because no change
  }
  $saveAnnouncement->title = $req->announcementTitle;
  $saveAnnouncement->description = $req->announcementDetails;
  $saveAnnouncement->save();
  return redirect()->action('upload_controller@viewAllAnnouncements')->with('message', 'Edit Successful');
}

// only img file present
if($saveAnnouncement->filetype == '1')
{
  if($req->file('imageFile'))
  {
    if(File::exists('public/myAssets/announcement/'.$saveAnnouncement->imgpath))
    // delete old file
    Storage::delete('public/myAssets/announcement/'.$saveAnnouncement->imgpath);
    $saveAnnouncement->filetype = "1";
    $saveAnnouncement->imgpath = $req->imageFile->hashName();
  }

  if($req->file('announcementFile'))
  {
    $saveAnnouncement->filetype = "3"; //fileType becomes 3 because image is already present and file is added
    $saveAnnouncement->filepath = $req->announcementFile->hashName();
  }

  if($req->file('announcementFile') && Input::hasFile('imageFile'))
  {
    $saveAnnouncement->filetype = "3";
  }

  if(!Input::hasFile('announcementFile') && !Input::hasFile('imageFile'))
  {
    $saveAnnouncement->filetype = "1"; // because no change
  }
  $saveAnnouncement->title = $req->announcementTitle;
  $saveAnnouncement->description = $req->announcementDetails;
  $saveAnnouncement->save();
  return redirect()->action('upload_controller@viewAllAnnouncements')->with('message', 'Edit Successful');
}

// only file present
if($saveAnnouncement->filetype == '2')
{
  if($req->file('imageFile'))
  {
    $saveAnnouncement->filetype = "3"; //fileType becomes 3 because file is already present and image is added
    $saveAnnouncement->imgpath = $req->imageFile->hashName();
  }

  if($req->file('announcementFile'))
  {
    if(File::exists('public/myAssets/announcement/'.$saveAnnouncement->filepath))
    Storage::delete('public/myAssets/announcement/'.$saveAnnouncement->filepath);
    $saveAnnouncement->filetype = "2";
    $saveAnnouncement->filepath = $req->announcementFile->hashName();
  }

  if($req->file('announcementFile') && Input::hasFile('imageFile'))
  {
    $saveAnnouncement->filetype = "3"; // because both files present
  }

  if(!Input::hasFile('announcementFile') && !Input::hasFile('imageFile'))
  {
    $saveAnnouncement->filetype = "2"; // because no change
  }
  $saveAnnouncement->title = $req->announcementTitle;
  $saveAnnouncement->description = $req->announcementDetails;
  $saveAnnouncement->save();
  return redirect()->action('upload_controller@viewAllAnnouncements')->with('message', 'Edit Successful');
}

// both files present
if($saveAnnouncement->filetype == '3')
{
  if($req->file('imageFile'))
  {
    if(File::exists('public/myAssets/announcement/'.$saveAnnouncement->imgpath))
    Storage::delete('public/myAssets/announcement/'.$saveAnnouncement->imgpath);
    $saveAnnouncement->imgpath = $req->imageFile->hashName();
  }

  if($req->file('announcementFile'))
  {
    if(File::exists('public/myAssets/announcement/'.$saveAnnouncement->filepath))
    Storage::delete('public/myAssets/announcement/'.$saveAnnouncement->filepath);
    $saveAnnouncement->filepath = $req->announcementFile->hashName();
  }
  // fileType remains same no matter what happens
  $saveAnnouncement->filetype = "3";
}
    $saveAnnouncement->title = $req->announcementTitle;
    $saveAnnouncement->description = $req->announcementDetails;
    $saveAnnouncement->save();
    return redirect()->action('upload_controller@viewAllAnnouncements')->with('message', 'Edit Successful');
        }

// ***************** Enable Specific Announcement *****************
public function enableAnnouncement($announcementId){
             $announcement = Announcement::find($announcementId);
             $announcement->status = "1";
            $announcement->save();

             return redirect()->action('upload_controller@viewAllAnnouncements');
        }

// ***************** Disable Specific Announcement *****************
public function disableAnnouncement($announcementId){
             $announcement = Announcement::find($announcementId);
             $announcement->status = "0";
            $announcement->save();

         return redirect()->action('upload_controller@viewAllAnnouncements');
        }

// ***************** Delete Specific Announcement *****************
public function deleteAnnouncement($announcementId){
             $announcement = Announcement::find($announcementId);

             if($announcement->filetype == 1){
               if(File::exists('public/myAssets/announcement/'.$saveAnnouncement->imgpath))
                  Storage::delete('public/myAssets/announcement/'.$announcement->imgpath);
           }
             if($announcement->filetype == 2){
             if(File::exists('public/myAssets/announcement/'.$saveAnnouncement->filepath))
             Storage::delete('public/myAssets/announcement/'.$announcement->filepath);
           }
             if($announcement->filetype == 3){
             if(File::exists('public/myAssets/announcement/'.$saveAnnouncement->imgpath))
              Storage::delete('public/myAssets/announcement/'.$announcement->imgpath);
              if(File::exists('public/myAssets/announcement/'.$saveAnnouncement->filepath))
             Storage::delete('public/myAssets/announcement/'.$announcement->filepath);
           }
             $announcement->delete();

          return redirect()->action('upload_controller@viewAllAnnouncements');
        }

// ***************** Delete Specific Announcement Image *****************
public function deleteAnnouncementImage($announcementId){
             $announcement = Announcement::find($announcementId);
             if(File::exists('public/myAssets/announcement/'.$announcement->imgpath))
             Storage::delete('public/myAssets/announcement/'.$announcement->imgpath);


             // if no file
             if($announcement->filepath==null){
               $announcement->filetype = '0'; // means no file or image
               $announcement->imgpath = null; //removing image name
               $announcement->save();
              }
              // if file present
              else{
                $announcement->filetype = '2'; //means now only file left
                $announcement->imgpath = null; //removing image name
                $announcement->save();
              }

          return redirect()->action('upload_controller@editAnnouncement', [$announcementId]);
        }

// ***************** Delete Specific Announcement File *****************
public function deleteAnnouncementFile($announcementId){
             $announcement = Announcement::find($announcementId);
             if(File::exists('public/myAssets/announcement/'.$announcement->filepath))
             Storage::delete('public/myAssets/announcement/'.$announcement->filepath);

             // if no image
             if($announcement->imgpath==null){
               $announcement->filetype = '0'; // means no file or image
               $announcement->filepath = null; //removing file name
               $announcement->save();
              }
              // if image present
              else{
                $announcement->filetype = '1'; //means now only image left
                $announcement->filepath = null; //removing file name
                $announcement->save();
              }
          return redirect()->action('upload_controller@editAnnouncement', [$announcementId]);
        }

// ***************** Search Announcement *****************
public function searchAnnouncement(Request $req)
{
  $searchResults = Announcement::where('title', 'LIKE', '%'.$req->search.'%')->get();
  return view('admin.announcement.searchResult',compact('searchResults'));
}



// ******************************************
    //             Image Functions
    //  ******************************************

    // Possible Status(int) Forms
// 0 -> not displayed on site
// 1 -> displayed on site

// Possible Type(int) Forms
// 1 -> Achievement Images
// 2 -> Project Images
// 3 -> Gallery Images
// 4 -> Slider Images

// ***************** Upload Image *****************
    public function uploadImage(Request $req){
        $saveFormData = new Image;

        // for image save
if($req->file('imageFile')){

  if($req->imageType=="1"){ // if imageType is achievement
Storage::put('public/myAssets/achievements', $req->imageFile);
  }
  if($req->imageType=="2"){ // if imageType is onGoingProjects
Storage::put('public/myAssets/onGoingProjects', $req->imageFile);
  }
  if($req->imageType=="3"){ // if imageType is gallery
Storage::put('public/myAssets/gallery', $req->imageFile);
  }
  if($req->imageType=="4"){ // if imageType is slider
Storage::put('public/myAssets/slider', $req->imageFile);
  }
        $saveFormData->type = $req->imageType;
        $saveFormData->title = $req->imageTitle;
        $saveFormData->imgpath = $req->imageFile->hashName();
        $saveFormData->status = "1";
        $saveFormData->save();
        return redirect::back()->with('message', 'Upload Successful');
        }
        }


// ***************** View All Achievement Images (type=1) *****************
     public function viewAllAchievementImages(){
        $enabledImages = Image::where([
                ['status', '=', '1'],
                ['type', '=', '1'],])
                ->latest()->paginate(10, ['*'], 'enabledTable');
         $disabledImages = Image::where([
                ['status', '=', '0'],
                ['type', '=', '1'],])
                ->latest()->paginate(10, ['*'], 'disabledTable');
                $imageType='Achievement Images';
         return view('admin.images.viewAllImages',compact('enabledImages', 'disabledImages', 'imageType'));
        }
// ***************** View All OnGoing Project Images (type=2) *****************
     public function viewAllOnGoingProjectImages(){
         $enabledImages = Image::where([
                ['status', '=', '1'],
                ['type', '=', '2'],])
                ->latest()->paginate(10, ['*'], 'enabledTable');
         $disabledImages = Image::where([
                ['status', '=', '0'],
                ['type', '=', '2'],])
                ->latest()->paginate(10, ['*'], 'disabledTable');
                $imageType='OnGoing Project Images';
         return view('admin.images.viewAllImages',compact('enabledImages', 'disabledImages', 'imageType'));
        }
// ***************** View All Gallery Images (type=3) *****************
     public function viewAllRandomImages(){
         $enabledImages = Image::where([
                ['status', '=', '1'],
                ['type', '=', '3'],])
                ->latest()->paginate(10, ['*'], 'enabledTable');
         $disabledImages = Image::where([
                ['status', '=', '0'],
                ['type', '=', '3'],])
                ->latest()->paginate(10, ['*'], 'disabledTable');
                $imageType='Gallery Images';
         return view('admin.images.viewAllImages',compact('enabledImages', 'disabledImages', 'imageType'));
        }
// ***************** View All Slider Images (type=4) *****************
     public function viewAllSliderImages(){
         $enabledImages = Image::where([
                ['status', '=', '1'],
                ['type', '=', '4'],])
                ->latest()->paginate(10, ['*'], 'enabledTable');
         $disabledImages = Image::where([
                ['status', '=', '0'],
                ['type', '=', '4'],])
                ->latest()->paginate(10, ['*'], 'disabledTable');
                $imageType='Slider Images';
         return view('admin.images.viewAllImages',compact('enabledImages', 'disabledImages', 'imageType'));
        }

// ***************** View/Edit Specific Image *****************
        public function editImage($imageType, $imageId){
             $image = Image::find($imageId);

         return view('admin.images.viewEditImage',compact('image'));
        }



// Possible cases
// Case 1 -> image uploaded but img type not changed
// Case 2 -> image uploaded and img type changed
// Case 3 -> image not uploaded but img type  changed
// Case 4 -> only title changed

// ***************** Save Edit Specific Image *****************
        public function saveEditImage(Request $req, $imageId){
            $saveFormData = Image::find($imageId);

// CASE 1
// ***************** if user added new image and did not change image type *****************
           if($req->file('imageFile') && $req->imageType == $saveFormData->type){

              // $req->imageType == 1 (achievements)
              if($req->imageType=='1'){
              // Upload Image
              Storage::put('public/myAssets/achievements', $req->imageFile);
              // delete old file
              if(File::exists('public/myAssets/achievements/'.$saveFormData->imgpath))
              Storage::delete('public/myAssets/achievements/'.$saveFormData->imgpath);

              $saveFormData->type = $req->imageType;
              $saveFormData->title = $req->imageTitle;
              $saveFormData->imgpath = $req->imageFile->hashName();
              $saveFormData->save();
              return redirect()->action('upload_controller@viewAllAchievementImages');
            }

              // $req->imageType == 2 (onGoingProjects)
              if($req->imageType=='2'){
              // Upload Image
              Storage::put('public/myAssets/onGoingProjects', $req->imageFile);
              // delete old file
              if(File::exists('public/myAssets/onGoingProjects/'.$saveFormData->imgpath))
              Storage::delete('public/myAssets/onGoingProjects/'.$saveFormData->imgpath);

              $saveFormData->type = $req->imageType;
              $saveFormData->title = $req->imageTitle;
              $saveFormData->imgpath = $req->imageFile->hashName();
              $saveFormData->save();
              return redirect()->action('upload_controller@viewAllOnGoingProjectImages');
            }

              // $req->imageType == 3 (gallery)
              if($req->imageType=='3'){
              // Upload Image
              Storage::put('public/myAssets/gallery', $req->imageFile);
              // delete old file
              if(File::exists('public/myAssets/gallery/'.$saveFormData->imgpath))
              Storage::delete('public/myAssets/gallery/'.$saveFormData->imgpath);

              $saveFormData->type = $req->imageType;
              $saveFormData->title = $req->imageTitle;
              $saveFormData->imgpath = $req->imageFile->hashName();
              $saveFormData->save();
              return redirect()->action('upload_controller@viewAllRandomImages');
            }

              // $req->imageType == 4 (slider)
              if($req->imageType=='4'){
              // Upload Image
              Storage::put('public/myAssets/slider', $req->imageFile);
              // delete old file
              if(File::exists('public/myAssets/slider/'.$saveFormData->imgpath))
              Storage::delete('public/myAssets/slider/'.$saveFormData->imgpath);

              $saveFormData->type = $req->imageType;
              $saveFormData->title = $req->imageTitle;
              $saveFormData->imgpath = $req->imageFile->hashName();
              $saveFormData->save();
              return redirect()->action('upload_controller@viewAllSliderImages');
            }
                }
// CASE 2
// ***************** if user added new image and changed image type *****************
                else if($req->file('imageFile') && $req->imageType != $saveFormData->type){

                    // $req->imageType == 1 (achievements)
                    if($req->imageType =='1'){

                      if($saveFormData->type == '2'){ // (onGoingProjects)
                      // Upload Image
                      Storage::put('public/myAssets/achievements', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/onGoingProjects/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/onGoingProjects/'.$saveFormData->imgpath);
                    }

                      if($saveFormData->type == '3'){ // (gallery)
                      // Upload Image
                      Storage::put('achievements', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/gallery/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/gallery/'.$saveFormData->imgpath);
                    }

                      if($saveFormData->type == '4'){ // (slider)
                      // Upload Image
                      Storage::put('public/myAssets/achievements', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/slider/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/slider/'.$saveFormData->imgpath);
                      }

                      $saveFormData->type = $req->imageType;
                      $saveFormData->title = $req->imageTitle;
                      $saveFormData->imgpath = $req->imageFile->hashName();
                      $saveFormData->save();
                      return redirect()->action('upload_controller@viewAllAchievementImages');
                    }

                      // $req->imageType == 2 (onGoingProjects)
                      if($req->imageType =='2'){

                      if($saveFormData->type == '1'){ // (achievements)
                     // Upload Image
                      Storage::put('public/myAssets/onGoingProjects', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/achievements/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/achievements/'.$saveFormData->imgpath);
                    }

                      if($saveFormData->type == '3'){  // (gallery)
                     // Upload Image
                      Storage::put('public/myAssets/onGoingProjects', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/gallery/'.$saveFormData->imgpath))
                      Storage::delete('gallery/'.$saveFormData->imgpath);
                    }

                      if($saveFormData->type == '4'){  // (slider)
                     // Upload Image
                      Storage::put('public/myAssets/onGoingProjects', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/slider/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/slider/'.$saveFormData->imgpath);
                    }

                      $saveFormData->type = $req->imageType;
                      $saveFormData->title = $req->imageTitle;
                      $saveFormData->imgpath = $req->imageFile->hashName();
                      $saveFormData->save();
                      return redirect()->action('upload_controller@viewAllOnGoingProjectImages');
                      }

                      // $req->imageType == 3 (gallery)
                      if($req->imageType =='3'){

                      if($saveFormData->type == '1'){ // (achievements)
                      // Upload Image
                      Storage::put('public/myAssets/gallery', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/achievements/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/achievements/'.$saveFormData->imgpath);
                      }

                      if($saveFormData->type == '2'){  // (onGoingProjects)
                      // Upload Image
                      Storage::put('public/myAssets/gallery', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/onGoingProjects/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/onGoingProjects/'.$saveFormData->imgpath);
                     }

                      if($saveFormData->type == '4'){  // (slider)
                      // Upload Image
                      Storage::put('public/myAssets/gallery', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/slider/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/slider/'.$saveFormData->imgpath);
                    }

                      $saveFormData->type = $req->imageType;
                      $saveFormData->title = $req->imageTitle;
                      $saveFormData->imgpath = $req->imageFile->hashName();
                      $saveFormData->save();
                      return redirect()->action('upload_controller@viewAllRandomImages');
                      }

                      // $req->imageType == 4 (slider)
                      if($req->imageType =='4'){

                      if($saveFormData->type == '1'){ // (achievements)
                      // Upload Image
                      Storage::put('public/myAssets/slider', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/achievements/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/achievements/'.$saveFormData->imgpath);
                   }
                      if($saveFormData->type == '2'){  // (onGoingProjects)
                     // Upload Image
                      Storage::put('public/myAssets/slider', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/onGoingProjects/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/onGoingProjects/'.$saveFormData->imgpath);
                    }

                      if($saveFormData->type == '3'){  // (gallery)
                     // Upload Image
                      Storage::put('public/myAssets/slider', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/gallery/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/gallery/'.$saveFormData->imgpath);
                    }

                      $saveFormData->type = $req->imageType;
                      $saveFormData->title = $req->imageTitle;
                      $saveFormData->imgpath = $req->imageFile->hashName();
                      $saveFormData->save();
                      return redirect()->action('upload_controller@viewAllSliderImages');
                  }
                } // end of if file type change and image uploaded

// CASE 3
// ***************** if user did not add new image and changed image type *****************
                else if(!$req->file('imageFile') && $req->imageType != $saveFormData->type){
                  // $req->imageType == 1 (achievements)
                    if($req->imageType =='1'){

                      if($saveFormData->type == '2')
                     Storage::move('public/myAssets/onGoingProjects/'.$saveFormData->imgpath, 'public/myAssets/achievements/'.$saveFormData->imgpath);
                      if($saveFormData->type == '3')
                     Storage::move('public/myAssets/gallery/'.$saveFormData->imgpath, 'public/myAssets/achievements/'.$saveFormData->imgpath);
                      if($saveFormData->type == '4')
                     Storage::move('public/myAssets/slider/'.$saveFormData->imgpath, 'public/myAssets/achievements/'.$saveFormData->imgpath);
                      $saveFormData->type = $req->imageType;
                      $saveFormData->title = $req->imageTitle;
                      $saveFormData->save();
                      return redirect()->action('upload_controller@viewAllAchievementImages');
                      }


                      // $req->imageType == 2 (onGoingProjects)
                      if($req->imageType =='2'){

                      if($saveFormData->type == '1')
                     Storage::move('public/myAssets/achievements/'.$saveFormData->imgpath, 'public/myAssets/onGoingProjects/'.$saveFormData->imgpath);
                      if($saveFormData->type == '3')
                     Storage::move('public/myAssets/gallery/'.$saveFormData->imgpath, 'public/myAssets/onGoingProjects/'.$saveFormData->imgpath);
                      if($saveFormData->type == '4')
                     Storage::move('public/myAssets/slider/'.$saveFormData->imgpath, 'public/myAssets/onGoingProjects/'.$saveFormData->imgpath);
                      $saveFormData->type = $req->imageType;
                      $saveFormData->title = $req->imageTitle;
                      $saveFormData->save();
                      return redirect()->action('upload_controller@viewAllOnGoingProjectImages');
                      }

                      // $req->imageType == 3 (gallery)
                      if($req->imageType =='3'){

                      if($saveFormData->type == '1')
                     Storage::move('public/myAssets/achievements/'.$saveFormData->imgpath, 'public/myAssets/gallery/'.$saveFormData->imgpath);
                      if($saveFormData->type == '2')
                     Storage::move('public/myAssets/onGoingProjects/'.$saveFormData->imgpath, 'public/myAssets/gallery/'.$saveFormData->imgpath);
                      if($saveFormData->type == '4')
                     Storage::move('public/myAssets/slider/'.$saveFormData->imgpath, 'public/myAssets/gallery/'.$saveFormData->imgpath);
                      $saveFormData->type = $req->imageType;
                      $saveFormData->title = $req->imageTitle;
                      $saveFormData->save();
                      return redirect()->action('upload_controller@viewAllRandomImages');
                      }

                      // $req->imageType == 4 (slider)
                      if($req->imageType =='4'){

                      if($saveFormData->type == '1')
                     Storage::move('public/myAssets/achievements/'.$saveFormData->imgpath, 'public/myAssets/slider/'.$saveFormData->imgpath);
                      if($saveFormData->type == '2')
                     Storage::move('public/myAssets/onGoingProjects/'.$saveFormData->imgpath, 'public/myAssets/slider/'.$saveFormData->imgpath);
                      if($saveFormData->type == '3')
                     Storage::move('public/myAssets/gallery/'.$saveFormData->imgpath, 'public/myAssets/slider/'.$saveFormData->imgpath);
                      $saveFormData->type = $req->imageType;
                      $saveFormData->title = $req->imageTitle;
                      $saveFormData->save();
                      return redirect()->action('upload_controller@viewAllSliderImages');
                  }
                }

// CASE 4
// ***************** if user only changed Title *****************
            else{
              $saveFormData->title = $req->imageTitle;
              $saveFormData->save();
              if($req->imageType =='1'){
              return redirect()->action('upload_controller@viewAllAchievementImages');
            }
              if($req->imageType =='2'){
              return redirect()->action('upload_controller@viewAllOnGoingProjectImages');
            }
              if($req->imageType =='3'){
              return redirect()->action('upload_controller@viewAllRandomImages');
            }
              if($req->imageType =='4'){
              return redirect()->action('upload_controller@viewAllSliderImages');
            }
            }
        }

// ***************** Enable Specific Image *****************
public function enableImage($imageType, $imageId){

            if($imageType=='1'){
             $image = Image::find($imageId);
             $image->status = "1";
            $image->save();
           return redirect()->action('upload_controller@viewAllAchievementImages');
        }
            if($imageType=='2'){
             $image = Image::find($imageId);
             $image->status = "1";
            $image->save();
           return redirect()->action('upload_controller@viewAllOnGoingProjectImages');
        }
            if($imageType=='3'){
             $image = Image::find($imageId);
             $image->status = "1";
            $image->save();
           return redirect()->action('upload_controller@viewAllRandomImages');
        }
            if($imageType=='4'){
             $image = Image::find($imageId);
             $image->status = "1";
            $image->save();
           return redirect()->action('upload_controller@viewAllRandomImages');
        }
        }

// ***************** Disable Specific Image *****************
public function disableImage($imageType, $imageId){
              if($imageType=='1'){
             $image = Image::find($imageId);
             $image->status = "0";
            $image->save();
           return redirect()->action('upload_controller@viewAllAchievementImages');
        }
            if($imageType=='2'){
             $image = Image::find($imageId);
             $image->status = "0";
            $image->save();
           return redirect()->action('upload_controller@viewAllOnGoingProjectImages');
        }
            if($imageType=='3'){
             $image = Image::find($imageId);
             $image->status = "0";
            $image->save();
           return redirect()->action('upload_controller@viewAllRandomImages');
        }
            if($imageType=='4'){
             $image = Image::find($imageId);
             $image->status = "0";
            $image->save();
           return redirect()->action('upload_controller@viewAllRandomImages');
        }
        }

// ***************** Delete Specific Image *****************
public function deleteImage($imageType, $imageId){

    $image = Image::find($imageId);

            if($imageType=='1'){
              if(File::exists('public/myAssets/achievements/'.$saveFormData->imgpath))
              Storage::delete('public/myAssets/achievements/'.$image->imgpath);
             $image->delete();
           return redirect()->action('upload_controller@viewAllAchievementImages');
        }

            if($imageType=='2'){
              if(File::exists('public/myAssets/onGoingProjects/'.$saveFormData->imgpath))
              Storage::delete('public/myAssets/onGoingProjects/'.$image->imgpath);
             $image->delete();
           return redirect()->action('upload_controller@viewAllOnGoingProjectImages');
        }

            if($imageType=='3'){
              if(File::exists('public/myAssets/gallery/'.$saveFormData->imgpath))
              Storage::delete('public/myAssets/gallery/'.$image->imgpath);
             $image->delete();
           return redirect()->action('upload_controller@viewAllRandomImages');
        }

            if($imageType=='4'){
              if(File::exists('public/myAssets/slider/'.$saveFormData->imgpath))
              Storage::delete('public/myAssets/slider/'.$image->imgpath);
             $image->delete();
           return redirect()->action('upload_controller@viewAllSliderImages');
        }
        }

// ***************** Search Image *****************
        public function searchImage(Request $req)
{
  $searchResults = Image::where('title', 'LIKE', '%'.$req->search.'%')->get();
  return view('admin.images.searchResult',compact('searchResults'));
}


    //  ******************************************
    //             Ciricular Functions
    //  ******************************************
// Possible Status(int) Forms
// 0 -> not displayed on site
// 1 -> displayed on site

// ***************** Upload Cicular *****************
    public function uploadCircular(Request $req){
         if($req->file('circularFile')){
      Storage::put('public/myAssets/circulars', $req->circularFile);

              $saveFormData = new Circular;
        $saveFormData->title = $req->circularTitle;
        $saveFormData->filepath = $req->circularFile->hashName();
        $saveFormData->status = "1";
        $saveFormData->save();
        return redirect::back()->with('message', 'Upload Successful');
    }
}

// ***************** View All Circulars *****************
     public function viewAllCirculars(){
         $enabledCirculars = Circular::where('status', 1)->latest()->paginate(10, ['*'], 'enabledTable');
         $disabledCirculars = Circular::where('status', 0)->latest()->paginate(10, ['*'], 'disabledTable');
         return view('admin.circulars.viewAllCirculars',compact('enabledCirculars', 'disabledCirculars'));
        }

// ***************** View/Edit Specific Circular *****************
        public function editCircular($circularId){
             $circular = Circular::find($circularId);
             return view('admin.circulars.viewEditCircular',compact('circular'));
        }

// ***************** Save Edit Specific Circular *****************
        public function saveEditCircular(Request $req, $circularId){

          $saveFormData = Circular::find($circularId);

               if($req->file('circularFile')){
              Storage::put('public/myAssets/circulars', $req->circularFile);
              // delete old file
              if(File::exists('public/myAssets/circulars/'.$saveFormData->filepath))
              Storage::delete('public/myAssets/circulars/'.$saveFormData->filepath);

                    $saveFormData->filepath = $req->circularFile->hashName();
               }
                    $saveFormData->title = $req->circularTitle;
                    $saveFormData->save();
                    return redirect()->action('upload_controller@viewAllCirculars');
    }


// ***************** Enable Specific Circular *****************
public function enableCircular($circularId){
             $circular = Circular::find($circularId);
             $circular->status = "1";
            $circular->save();
           return redirect()->action('upload_controller@viewAllCirculars');
        }

// ***************** Disable Specific Circular *****************
public function disableCircular($circularId){
             $circular = Circular::find($circularId);
             $circular->status = "0";
            $circular->save();
           return redirect()->action('upload_controller@viewAllCirculars');
        }

// ***************** Delete Specific Circular *****************
public function deleteCircular($circularId){
             $circular = Circular::find($circularId);
             if(File::exists('public/myAssets/circulars/'.$circular->filepath))
             Storage::delete('public/myAssets/circulars/'.$circular->filepath);

            $circular->delete();
           return redirect()->action('upload_controller@viewAllCirculars');
        }

// ***************** Search Circular *****************
        public function searchCircular(Request $req)
{
  $searchResults = Circular::where('title', 'LIKE', '%'.$req->search.'%')->get();
  return view('admin.circulars.searchResult',compact('searchResults'));
}


// ******************************************
//             Member Functions
//  ******************************************
// Possible Status(int) Forms
// 0 -> not displayed on site
// 1 -> displayed on site
// Possible type(int) Forms
// 1 -> committe member
// 2 -> focal member

// ***************** Add Member *****************
    public function addMember(Request $req){

      if($req->memberType=="1"){ // if memberCategory is focal person
          if($req->file('imageFile')){
          Storage::put('public/myAssets/MC', $req->imageFile);

              $saveFormData = new Member;
        $saveFormData->type = $req->memberType;
        $saveFormData->name = $req->memberName;
        $saveFormData->position = $req->memberPosition1;
        $saveFormData->contact = $req->memberContactNo;
        $saveFormData->email = $req->memberEmail;
        $saveFormData->imgpath = $req->imageFile->hashName();
        $saveFormData->status = "1";
        $saveFormData->save();
        return redirect::back()->with('message', 'Member Addded Successfully');
        }
      }

        if($req->memberType=="2") // if memberCategory is focal person
        {
                if($req->file('imageFile')){
          Storage::put('public/myAssets/FP', $req->imageFile);

              $saveFormData = new Member;
        $saveFormData->type = $req->memberType;
        $saveFormData->name = $req->memberName;
        $saveFormData->position = $req->memberPosition2;
        $saveFormData->contact = $req->memberContactNo;
        $saveFormData->email = $req->memberEmail;
        $saveFormData->imgpath = $req->imageFile->hashName();
        $saveFormData->status = "1";
        $saveFormData->save();
        return redirect::back()->with('message', 'Member Addded Successfully');
        }
        }
    }
// ***************** View All Members *****************
    public function viewAllMembers(){
        return view('admin.members.viewAllMembers');
    }

// ***************** View All Managment Committe Member *****************
     public function viewAllManagmentCommitteMembers(){
        $enabledMembers = Member::where([
                ['status', '=', '1'],
                ['type', '=', '1'],])
                ->latest()->paginate(10, ['*'], 'enabledTable');

             $disabledMembers = Member::where([
                 ['status', '=', '0'],
                 ['type', '=', '1'],])
                 ->latest()->paginate(10, ['*'], 'disabledTable');
                 $memberType='Committe Members';
         return view('admin.members.viewAllMembers',compact('enabledMembers', 'disabledMembers', 'memberType'));
        }
// ***************** View All Focal Member *****************
     public function viewAllFocalMembers(){
         $enabledMembers = Member::where([
                                ['status', '=', '1'],
                                ['type', '=', '2'],])
                                ->latest()->paginate(10, ['*'], 'enabledTable');
         $disabledMembers = Member::where([
                                ['status', '=', '0'],
                                ['type', '=', '2'],])
                                ->latest()->paginate(10, ['*'], 'disabledTable');
                                $memberType='Focal Members';
         return view('admin.members.viewAllMembers',compact('enabledMembers', 'disabledMembers', 'memberType'));
        }

// ***************** View/Edit Specific Member *****************
        public function editMember($memberType, $memberId){
            if($memberType=='1')
             $member = Member::find($memberId);

             if($memberType=='2')
             $member = Member::find($memberId);

         return view('admin.members.viewEditMember',compact('member'));
        }

// Possible cases
// Case 1 -> image uploaded but img type not changed
// Case 2 -> image uploaded and img type changed
// Case 3 -> image not uploaded but img type  changed
// Case 4 -> only title changed

// ***************** Save Edit Specific Image *****************
       public function saveEditMember(Request $req, $memberType, $memberId){
            $saveFormData = Member::find($memberId);

// CASE 1
// ***************** if user added new image and did not change member type *****************
           if($req->file('imageFile') && $req->memberType == $saveFormData->type){

              // $req->memberType == 1 (Committe)
              if($req->memberType=='1'){
              // Upload Image
              Storage::put('public/myAssets/MC', $req->imageFile);
              // delete old file
              if(File::exists('public/myAssets/MC/'.$saveFormData->imgpath))
              Storage::delete('public/myAssets/MC/'.$saveFormData->imgpath);

                    $saveFormData->type = $req->memberType;
                    $saveFormData->name = $req->memberName;
                    $saveFormData->position = $req->memberPosition1;
                    $saveFormData->contact = $req->memberContactNo;
                    $saveFormData->email = $req->memberEmail;
                    $saveFormData->imgpath = $req->imageFile->hashName();

                    $saveFormData->save();
              return redirect()->action('upload_controller@viewAllManagmentCommitteMembers');
            }

              // $req->memberType == 2 (Focal Person)
              if($req->memberType=='2'){
              // Upload Image
              Storage::put('public/myAssets/FP', $req->imageFile);
              // delete old file
              if(File::exists('public/myAssets/FP/'.$saveFormData->imgpath))
              Storage::delete('public/myAssets/FP/'.$saveFormData->imgpath);

              $saveFormData->type = $req->memberType;
                    $saveFormData->name = $req->memberName;
                    $saveFormData->position = $req->memberPosition2;
                    $saveFormData->contact = $req->memberContactNo;
                    $saveFormData->email = $req->memberEmail;
                    $saveFormData->imgpath = $req->imageFile->hashName();

                    $saveFormData->save();
              return redirect()->action('upload_controller@viewAllFocalMembers');
            }
                }
// CASE 2
// ***************** if user added new image and changed member type *****************
                else if($req->file('imageFile') && $req->memberType != $saveFormData->type){

                    // $req->memberType == 1 (achievements)
                    if($req->memberType =='1'){

                      if($saveFormData->type == '2'){ // (FP)
                      // Upload Image
                      Storage::put('public/myAssets/MC', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/FP/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/FP/'.$saveFormData->imgpath);
                    }

                      $saveFormData->type = $req->memberType;
                    $saveFormData->name = $req->memberName;
                    $saveFormData->position = $req->memberPosition1;
                    $saveFormData->contact = $req->memberContactNo;
                    $saveFormData->email = $req->memberEmail;
                    $saveFormData->imgpath = $req->imageFile->hashName();

                    $saveFormData->save();
              return redirect()->action('upload_controller@viewAllManagmentCommitteMembers');
                    }

                      // $req->memberType == 2 (FP)
                      if($req->memberType =='2'){

                      if($saveFormData->type == '1'){ // (MC)
                     // Upload Image
                      Storage::put('public/myAssets/FP', $req->imageFile);
                      // delete old file
                      if(File::exists('public/myAssets/MC/'.$saveFormData->imgpath))
                      Storage::delete('public/myAssets/MC/'.$saveFormData->imgpath);
                    }

                      $saveFormData->type = $req->memberType;
                    $saveFormData->name = $req->memberName;
                    $saveFormData->position = $req->memberPosition2;
                    $saveFormData->contact = $req->memberContactNo;
                    $saveFormData->email = $req->memberEmail;
                    $saveFormData->imgpath = $req->imageFile->hashName();

                    $saveFormData->save();
              return redirect()->action('upload_controller@viewAllFocalMembers');
                      }

                } // end of if file type change and image uploaded

// CASE 3
// ***************** if user did not add new image and changed Member type *****************
                else if(!$req->file('imageFile') && $req->memberType != $saveFormData->type){
                  // $req->memberType == 1 (MC)
                    if($req->memberType =='1'){

                      if($saveFormData->type == '2')
                     Storage::move('public/myAssets/FP/'.$saveFormData->imgpath, 'public/myAssets/MC/'.$saveFormData->imgpath);

                      $saveFormData->type = $req->memberType;
                    $saveFormData->name = $req->memberName;
                    $saveFormData->position = $req->memberPosition1;
                    $saveFormData->contact = $req->memberContactNo;
                    $saveFormData->email = $req->memberEmail;

                    $saveFormData->save();
              return redirect()->action('upload_controller@viewAllManagmentCommitteMembers');
                      }


                      // $req->memberType == 2 (FP)
                      if($req->memberType =='2'){

                      if($saveFormData->type == '1')
                     Storage::move('public/myAssets/MC/'.$saveFormData->imgpath, 'public/myAssets/FP/'.$saveFormData->imgpath);

                      $saveFormData->type = $req->memberType;
                    $saveFormData->name = $req->memberName;
                    $saveFormData->position = $req->memberPosition2;
                    $saveFormData->contact = $req->memberContactNo;
                    $saveFormData->email = $req->memberEmail;

                    $saveFormData->save();
              return redirect()->action('upload_controller@viewAllFocalMembers');
                      }


                }

// CASE 4
// ***************** if user only changed data other than member type or uploads image *****************
            else{
              if($req->memberType =='1'){
                $saveFormData->type = $req->memberType;
                    $saveFormData->name = $req->memberName;
                    $saveFormData->position = $req->memberPosition1;
                    $saveFormData->contact = $req->memberContactNo;
                    $saveFormData->email = $req->memberEmail;

                    $saveFormData->save();
              return redirect()->action('upload_controller@viewAllManagmentCommitteMembers');
            }
              if($req->memberType =='2'){
                $saveFormData->type = $req->memberType;
                    $saveFormData->name = $req->memberName;
                    $saveFormData->position = $req->memberPosition2;
                    $saveFormData->contact = $req->memberContactNo;
                    $saveFormData->email = $req->memberEmail;

                    $saveFormData->save();
              return redirect()->action('upload_controller@viewAllFocalMembers');
            }

            }
        }

// ***************** Enable Specific Member *****************
public function enableMember($memberType, $memberId){

            if($memberType=='1'){
             $member = Member::find($memberId);
             $member->status = "1";
            $member->save();
           return redirect()->action('upload_controller@viewAllManagmentCommitteMembers');
        }
            if($memberType=='2'){
             $member = Member::find($memberId);
             $member->status = "1";
            $member->save();
           return redirect()->action('upload_controller@viewAllFocalMembers');
        }
        }

// ***************** Disable Specific Member *****************
public function disableMember($memberType, $memberId){
              if($memberType=='1'){
             $member = Member::find($memberId);
             $member->status = "0";
            $member->save();
           return redirect()->action('upload_controller@viewAllManagmentCommitteMembers');
        }
            if($memberType=='2'){
             $member = Member::find($memberId);
             $member->status = "0";
            $member->save();
           return redirect()->action('upload_controller@viewAllFocalMembers');
        }
        }

// ***************** Delete Specific Member *****************
public function deleteMember($memberType, $memberId){
            if($memberType=='1'){
             $member = Member::find($memberId);
             if(File::exists('public/myAssets/MC/'.$member->imgpath))
             Storage::delete('public/myAssets/MC/'.$member->imgpath);

            $member->delete();
           return redirect()->action('upload_controller@viewAllManagmentCommitteMembers');
        }
            if($memberType=='2'){
             $member = Member::find($memberId);
             if(File::exists('public/myAssets/FP/'.$member->imgpath))
             Storage::delete('public/myAssets/FP/'.$member->imgpath);

            $member->delete();
           return redirect()->action('upload_controller@viewAllFocalMembers');
        }
        }

// ***************** Search Member *****************
        public function searchMember(Request $req)
{
  $searchResults = Member::where('name', 'LIKE', '%'.$req->search.'%')->get();
  return view('admin.members.searchResult',compact('searchResults'));
}


// ******************************************
//             Visitor Message Functions
//  ******************************************
// Possible Status(int) Forms
// 0 -> UnRead message
// 1 -> admin only Read message
// 2 -> admin replied to messages
// 3 -> indicates that message is admin response



// ***************** View Visitor Message *****************
public function viewAllMessages(Request $req)
{
  $unreadMessages = Message::where('status', '0')->latest()->paginate(10, ['*'], 'unreadTable');
  $readMessages = Message::where([ // show only messages that are 1->read or 2->replied to
    ['status', '!=','0'],
    ['status', '!=','3'],
    ])->latest()->paginate(10, ['*'], 'readTable');
  return view('admin.messages.viewAllMessages',compact('unreadMessages', 'readMessages'));
}

// ***************** View Specific Visitor Message *****************
public function viewMessage($messageId)
{
  $message = Message::find($messageId);
  $allPreviousEmails = Message::where('senderEmail', $message->senderEmail)->get();
  return view('admin.messages.replyMessage', compact('message', '$allPreviousEmails'));
}
// ***************** View All Replies to a Specific Message Sender *****************
public function viewAllMessagesOfSpecificSender($messageId)
{
  $recipientData = Message::find($messageId); // visitor Message
  $visitorPrevMessages = Message::where('senderEmail', $recipientData->senderEmail)->get();
  $adminResponses = Message::where('recipientEmail', $recipientData->senderEmail)->get();
  foreach ($visitorPrevMessages as $individualVisitorPrevMessage) {
    $visitorPrevMessage[] = $individualVisitorPrevMessage;
  }
  foreach ($adminResponses as $individualAdminResponse) {
    $adminResponse[] = $individualAdminResponse;
  }
  return view('admin.messages.oldMessages', compact('visitorPrevMessage', 'adminResponse'));
}
// ***************** Reply Visitor Message *****************
public function replyMessage(Request $req, $messageId)
{
  $recipientData = Message::find($messageId); // visitor Message
  $reply = new Message();
  $reply->repliedToId = $messageId;
  $reply->name = 'Admin';
  $reply->senderEmail = '0'; // 0 = site admin
  $reply->recipientEmail = $recipientData->senderEmail;
  $reply->message = $req->messageReply;
  $reply->status = '3'; // indicates admin response
  $reply->save();

$recipientData->status='2'; // changes visitor message state to replied
$recipientData->save();
  Mail::send(new reply($recipientData));
return redirect()->action('upload_controller@viewAllMessages');
}

// ***************** Mark as unread Message *****************
public function markAsUnreadMessage($messageId){
             $message = Message::find($messageId);
             $message->status = "0";
            $message->save();

             return redirect()->action('upload_controller@viewAllMessages');
        }
// ***************** Mark as read Message *****************
public function markAsReadMessage($messageId){
             $message = Message::find($messageId);
             $message->status = "1";
            $message->save();

         return redirect()->action('upload_controller@viewAllMessages');
        }
// ***************** Delete Specific Message *****************
public function deleteMessage($messageId){
             $message = Message::find($messageId);
            $message->delete();

         return redirect()->action('upload_controller@viewAllMessages');
        }

public function searchSender(Request $req)
{
  $searchResults = Message::where('name', 'LIKE', '%'.$req->search.'%')->orWhere('senderEmail', 'LIKE', '%'.$req->search.'%')->get();
  return view('admin.messages.searchResult',compact('searchResults'));
  // dd($searchSender);
}

}
