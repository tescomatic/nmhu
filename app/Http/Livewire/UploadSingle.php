<?php

namespace App\Http\Livewire;

use App\Models\Albums;
use App\Models\Songs;
use Facade\FlareClient\Stacktrace\File;
use getid3_writetags;
use Illuminate\Http\Testing\File as TestingFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Owenoj\LaravelGetId3\GetId3;
use SplFileInfo;
use Illuminate\Support\Str;

class UploadSingle extends Component
{
    use WithFileUploads;

    public $song;
    public $ids;
    public $done = 0;
    public $art;
    public $artist, $title, $feature, $lyrics, $cover, $video_link, $index, $producer, $finished, $pic, $slug;
    public $album;
    public $description;
    public $genres = [];
    public $lists = [2, 4, 6, 8, 9];
    public $genre = "";
    public $changed = false;
    public $albums = [];
    public $raw;
    public $release_date;
    public $ready = false;
    public $all;
    public $userId;
    public $info;



    public function red($i)
    {

        array_splice($this->lists, $i, 1);
    }

    public function updatedCover()
    {

        try {
            $this->validate([
                'cover' => 'max:50000|mimes:png,jpg,jpeg|image',
            ]);
            $this->art = $this->cover->temporaryUrl();
            $this->changed = true;
        } catch (\Throwable $th) {
            $this->emit('snack', 'Something went wrong');
        }
    }
    public function updatedSong()
    {

        try {
            $this->done = 0;
            $this->validate([
                'song' => 'max:100000|mimes:mp3,wav,ogg,m4a',
            ]);
            $this->done = 1;

            $this->emit('another');
            $this->make('get');
        } catch (\Throwable $th) {
            $this->emit('snack', 'Something went wrong');
        }
    }

    public function make($param)
    {


        try {

            $track = new getID3($this->song->getRealPath());


            $this->artist = $track->getArtist() ?? auth()->user()->stage_name;

            $this->title = $track->getTitle() ?? '';
            $this->genre = implode(',', $track->getGenres()) ?? null;

            // $this->genre = implode(',', $track->getGenres());



            if (isset($track->extractInfo()['id3v2']['APIC']) && !empty($track->extractInfo()['id3v2']['APIC'])) {
                $this->art = 'data:' .  $track->extractInfo()['id3v2']['APIC'][0]['image_mime'] . ';charset=utf-8;base64,' . base64_encode($track->extractInfo()['id3v2']['APIC'][0]['data']);
                $this->raw = base64_encode($track->extractInfo()['id3v2']['APIC'][0]['data']);
            } elseif (isset($track->extractInfo()['comments']['picture'][0]['data']) && !empty($track->extractInfo()['comments']['picture'][0]['data'])) {
                $this->art = 'data:' .  $track->extractInfo()['id3v2']['APIC'][0]['image_mime'] . ';charset=utf-8;base64,' . base64_encode($track->extractInfo()['id3v2']['APIC'][0]['data']);
                $this->raw = base64_encode($track->extractInfo()['id3v2']['APIC'][0]['data']);
            }


            if ($param == "get") {
                return false;
            }

            $this->changed == true ? $this->art =  $this->cover->temporaryUrl() : '';
        } catch (\Throwable $th) {
            // $this->emit('snack',['Some'])
        }
    }

    public function writes()
    {
        try {

            $TextEncoding = 'UTF-8';
            $track = new getID3($this->song->getRealPath());


            $r = $track->getArtist() ?? '';

            $r = $track->getTitle() ?? '';
            $r = $track->getAlbum() ?? '';
            $r = implode(',', $track->getGenres())  ?? null;
            $this->album = $this->album ?? 'naipod.com';
            $tagwriter = new getid3_writetags();
            $tagwriter->filename = $this->song->getRealPath();
            $tagwriter->tagformats = array('id3v2.3');
            $tagwriter->overwrite_tags    = true;
            $tagwriter->remove_other_tags = false;
            $tagwriter->tag_encoding      = $TextEncoding;
            $tagwriter->remove_other_tags = true;
            $TagData = array(
                'title'                  => array($this->title . " | Naipod.com"),
                'artist'                 => array($this->artist),
                'album'                  => array($this->album),
                'year'                   => array($this->release_date),
                'genre'                  => array($this->genre),
                'comment'                => array('Naipod.com'),
                'track_number'           => array('04/16'),
                'lyrics' => [$this->lyrics],
                'attached_picture' => array(
                    array(
                        'data' => file_get_contents(asset('images/naipodart.jpg')),
                        'picturetypeid' => 3,
                        'mime' => 'image/png',
                        'description' => 'Naipod.com'
                    )
                )
            );
            $tagwriter->tag_data = $TagData;
            // write tags
            if ($tagwriter->WriteTags()) {
                // dd("success");
                // echo 'Successfully wrote tags<br>';
                // if (!empty($tagwriter->warnings)) {
                //     echo 'There were some warnings:<br>' . implode('<br><br>', $tagwriter->warnings);
                // }
            } else {
                //dd("Error");
                // echo 'Failed to write tags!<br>' . implode('<br><br>', $tagwriter->errors);
            }

            return true;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function upload()
    {
        try {


            //$this->dispatchBrowserEvent('finished', ['id' => $this->ids]);

            $slug = Str::slug($this->title, '-');
            //  $slug=str_replace(['/','@','+','=','$','%','!','&','*','<','>','?','|'],'-', $this->title);


            $this->all = [

                'artist' => $this->artist, 'title' => $this->title, 'feature' => $this->feature,
                'lyrics' => $this->lyrics, 'song' => $this->song, 'video_link' => $this->video_link, 'description' => $this->description,
                'release_date' => $this->release_date, 'producer' => $this->producer,
                'genre' => $this->genre, 'album' => $this->album, 'albumId' => ''
            ];

            $all = Validator::make($this->all, [

                'title' => 'string|max:100',
                'artist' => 'required|string|max:100',
                'feature' => 'nullable|string|max:100',
                'producer' => 'nullable|string|max:200',
                'genre' => 'required|string|max:100',
                'album' => 'nullable|string|max:100',
                'description' => 'nullable|string|max:100',
                'lyrics' => 'string|nullable',
                'video_link' => 'nullable|string|max:500',
                'release_date' => 'required',
                'producer' => 'required',
                'song' => 'max:100000|mimes:mp3,wav,ogg,m4a',


            ]);

            if (!$all->passes()) {
                return $this->emit('snack', [$all->messages()->first()]);
            }

            if (!$this->changed && !$this->art) {
                return $this->emit('snack', ['The cover field is required', '']);
            }


            $this->writes();

            $img = 'covers/' .  time() . mt_rand(1000, 9000) . '.png';
            $this->pic = $img;


            if (!$this->changed) {

                $p = Storage::disk('s3')->put($img, file_get_contents($this->art), 'public');
            } else {
                $p = Storage::disk('s3')->put($img, file_get_contents($this->cover->temporaryUrl()), 'public');
            }
            $info = new SplFileInfo($this->song->getFileName());
            $info = $info->getExtension();




            $song = auth()->user()->url . $this->title . '.' . $info;
            $song = $this->song->storePubliclyAs('tzee', $this->title . ' | Naipod.com.' . $info, 's3');

            $album = Albums::where(['name' => $this->album], ['userId' => $this->userId])->first();

            if (!$album && $this->album != 'naipod.com') {
                $alb = Albums::create(['name' => $this->album, 'userId' => $this->userId]);

                $this->all['albumId'] = $alb['albumId'];
            } else if ($album) {
                $this->all['albumId'] = $album->albumId;
            } else {

                $this->all['albumId'] = null;
            }

            $this->all['art'] = $img;
            $this->slug = $this->all['slug'] = $slug;
            $this->all['song'] = $song;
            $this->all['userId'] = $this->userId;
            $this->all['release'] = $this->release_date;


            $newSong = Songs::create($this->all);
            $newSong['url'] = auth()->user()->url;
            $this->info = $newSong;
            !$this->description ? $this->description = 'Stream, share and download my new song on naipod.com' : '';
            $this->finished = true;
            return $this->emit('snack', [$this->title . " has been uploaded successfully"]);
        } catch (\Throwable $th) {

            return $this->emit('snack', ["Something went wrong, please check that you are connected to the internet"]);
        }
    }

    public function mount(...$data)
    {
        if (Auth::check()) {
            $this->userId = auth()->user()->id;
        }
        $this->ids = $data[0];
        $this->index = $data[1];
    }

    public function getAlbums()
    {
        $this->albums = Albums::where('userId', $this->userId)->get();
    }

    public function share()
    {
        $this->emit('share', $this->info);
    }
    public function slugs($str)
    {
        $slug = Str::of($str)->slug('-');
        $a = Songs::where([['slug', $slug], ['userId', $this->userId]])->first() ?? null;
        if ($a) {
            $this->slugs($slug . '-' . mt_rand(1000, 10000));
        } else {
            $this->slug = $slug;
            return $slug;
        }
    }
    public function hydrate()
    {

        if (!Auth::check()) {

            $this->emit('snack', ['Please login first ', '']);
            return redirect()->to('/');
        }
    }
    public function render()
    {
        $this->genres = DB::table('genre')->get();
        $this->getAlbums();
        return view('livewire.upload-single');
    }
}
