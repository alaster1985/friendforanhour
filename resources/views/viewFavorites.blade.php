@include('layouts.header')

<section id="favorites">
  <div class="container">
    <h2>Избранное:</h2>

    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-10 col-11 favorites-card">
          <ul class="favorites-list">
              <li class="favorites-item">
                  
                  <div class="favorites-user-image">
                      <a href="#">
                          <img src="{{asset($profile->profilePhoto()
                              ->where([['main_photo_marker', '=', 1], ['is_deleted', '=', 0]])
                              ->first()->photo_path ?? 'profilepictures/'
                              .$profile->gender_id . '.jpg')}}">
                      </a>
                  </div>
                  <div class="favorites-user-name">
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