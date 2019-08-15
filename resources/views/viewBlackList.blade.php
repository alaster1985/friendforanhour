@include('layouts.header')

<section id="blacklist">
  <div class="container">
    <h2>Черный список:</h2>

    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-10 col-11 blacklist-card">
          <ul class="blacklist-list">
              <li class="blacklist-item">
                  
                  <div class="blacklist-user-image">
                      <a href="#">
                          <img src="{{asset($profile->profilePhoto()
                              ->where([['main_photo_marker', '=', 1], ['is_deleted', '=', 0]])
                              ->first()->photo_path ?? 'profilepictures/'
                              .$profile->gender_id . '.jpg')}}">
                      </a>
                  </div>
                  <div class="blacklist-user-name">
                      <a href="#">First Name Second Name</a>
                  </div>

                  <button type="button" class="btn btn-default btn btn-primary btn-md"><i class="fas fa-times"></i></button>

              </li>
          </ul>
        </div>
    </div>

  </div>
</section>

@include('layouts.footer')