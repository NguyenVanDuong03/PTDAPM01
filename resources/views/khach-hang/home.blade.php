@extends('layouts.customer')
@section('banner')
    <div class="content">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
            </ol>
            <div class="carousel-inner carousel-container">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col col-padding">
                            <img src="{{ url('images/anh.png') }}" class="d-block" alt="Slide 1">
                        </div>
                        <div class="col col-padding">
                            <img src="{{ url('images/anh.png') }}" class="d-block" alt="Slide 2">
                        </div>
                        <div class="col col-padding">
                            <img src="{{ url('images/anh.png') }}" class="d-block" alt="Slide 3">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col col-padding">
                            <img src="{{ url('images/anh.png') }}" class="d-block h-300" alt="Slide 1">
                        </div>
                        <div class="col col-padding">
                            <img src="{{ url('images/anh.png') }}" class="d-block" alt="Slide 2">
                        </div>
                        <div class="col col-padding">
                            <img src="{{ url('images/anh.png') }}" class="d-block" alt="Slide 3">
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-target="#myCarousel" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#myCarousel" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </div>
@endsection
@section('main')
    <!-- BEGIN: Main -->
    <main>
        <div class="content ">
            <div class="movieshowing">
                <h3 class="container">Phim Đang Chiếu</h3>
                <div class="card-deck card-slide" id="cardDeck">
                    <span id="prevBtn" class="control">&#10094;</span>
                    @foreach($phimDangChieus as $phim)
                    <div class="card col-3">
                        <img  data-toggle="modal" data-target="#A{{$phim->MaPhim}}" src="{{$phim->DuongDan}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-danger">{{$phim->TenPhim}}</h5>
                            <p class="card-text">Thể Loại: {{$phim->theloai->TenTheLoai}}</p>
                            <p class="card-text">Thời Lượng: {{$phim->ThoiLuong}}</p>
                            <p class="card-text">Ngày Khởi Chiếu: {{$phim->NgayCongChieu}}</p>
                            <a href="{{route('datves.hienThoiGian', ['MaPhim' => $phim->MaPhim])}}" class="btn gradient-background-btn container">Mua vé</a>
                           
                        </div>
                    </div>
                    <div class="modal fade" id="A{{$phim->MaPhim}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" style="color: rgb(187, 87, 87);">Chi Tiết
                                        Phim</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="movie-poster">
                                        <img class="img-poster" src="{{ $phim->DuongDan }}" alt="Movie Poster">
                                    </div>
                                    <div class="movie-info">
                                        <h4 style="color: red;">{{$phim->TenPhim}}</h4>
                                       <br>
                                        <span><b style="font-weight: bold;">Thể Loại:</b>{{$phim->theloai->TenTheLoai}}</span><br>
                                        <span><b style="font-weight: bold;">Thời Lượng:</b>{{$phim->ThoiLuong}}</span><br>
                                        <span><b style="font-weight: bold;">Ngày Khởi Chiếu:</b> {{$phim->NgayCongChieu}}</span><br>
                                    </div>
                                </div>
                                <div id="movieDescription" class="movie-description">
                                {{$phim->MoTa}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
                    <span id="nextBtn" class="control">&#10095;</span>
                </div>
            </div>
            <div class="upcomingmovies">
                <h3 class="container">Phim Sắp Chiếu</h3>
                <div class="card-deck card-slide" id="cardDeck2">
                    <span id="prevBtn2" class="control">&#10094;</span>
                    @foreach($phimSapChieus as $phim)
                    <div class="card col-3">
                        <img data-toggle="modal" data-target="#A{{$phim->MaPhim}}" src="{{ $phim->DuongDan }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-danger">{{$phim->TenPhim}}</h5>
                            <p class="card-text">Thể Loại: {{$phim->theloai->TenTheLoai}}</p>
                            <p class="card-text">Thời Lượng: {{$phim->ThoiLuong}}</p>
                            <p class="card-text">Ngày Khởi Chiếu: {{$phim->NgayCongChieu}}</p>
                            <a href="{{route('datves.hienThoiGian',['MaPhim' => $phim->MaPhim])}}" class="btn gradient-background-btn container">Mua vé</a>
                        </div>
                    </div>

                     <!-- Modal -->
                     
                    <div class="modal fade" id="A{{$phim->MaPhim}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" style="color: rgb(187, 87, 87);">Chi Tiết
                                        Phim</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="movie-poster">
                                        <img class="img-poster" src="{{ $phim->DuongDan }}" alt="Movie Poster">
                                    </div>
                                    <div class="movie-info">
                                        <h4 style="color: red;">{{$phim->TenPhim}}</h4>
                                       <br>
                                        <span><b style="font-weight: bold;">Thể Loại:</b>{{$phim->theloai->TenTheLoai}}</span><br>
                                        <span><b style="font-weight: bold;">Thời Lượng:</b>{{$phim->ThoiLuong}}</span><br>
                                        <span><b style="font-weight: bold;">Ngày Khởi Chiếu:</b> {{$phim->NgayCongChieu}}</span><br>
                                    </div>
                                </div>
                                <div id="movieDescription" class="movie-description">
                                {{$phim->MoTa}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                                <span id="nextBtn2" class="control">&#10095;</span>
                </div>
            </div>
        </div>
                    
    </main>
    <!-- END: Main -->
    @if (session('SuaTaiKhoan'))
    <div id="toast">
        <div class="message message--success">
            <div class="message__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#47d864"
                    class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
            </div>
            <div class="message__body">
                <h3 class="message__title mb-0">{{ session('SuaTaiKhoan') }}</h3>

            </div>
            <div class="message__close">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-x-lg"
                    viewBox="0 0 16 16">
                    <path
                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                </svg>
            </div>
        </div>
    </div>
    {{session()->forget('SuaTaiKhoan')}}
    @endif
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cardDeck = document.getElementById('cardDeck');
            const cards = cardDeck.querySelectorAll('.card');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            let currentCardIndex = 0;
            const cardToShow = 4;

            function showCards() {
                cards.forEach((card, index) => {
                    if (index >= currentCardIndex && index < currentCardIndex + cardToShow) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            function updateButtons() {
                prevBtn.style.display = currentCardIndex === 0 ? 'block' : 'block';
                nextBtn.style.display = currentCardIndex + cardToShow >= cards.length ? 'block' : 'block';
            }

            function nextSlide() {
                if (currentCardIndex + cardToShow < cards.length) {
                    currentCardIndex += 1;
                    showCards();
                    updateButtons();
                }
            }

            function prevSlide() {
                if (currentCardIndex > 0) {
                    currentCardIndex -= 1;
                    showCards();
                    updateButtons();
                }
            }

            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);

            showCards();
            updateButtons();
        });
        document.addEventListener("DOMContentLoaded", function() {
            const cardDeck = document.getElementById('cardDeck2');
            const cards = cardDeck.querySelectorAll('.card');
            const prevBtn = document.getElementById('prevBtn2');
            const nextBtn = document.getElementById('nextBtn2');

            let currentCardIndex = 0;
            const cardToShow = 4;

            function showCards() {
                cards.forEach((card, index) => {
                    if (index >= currentCardIndex && index < currentCardIndex + cardToShow) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            function updateButtons() {
                prevBtn.style.display = currentCardIndex === 0 ? 'block' : 'block';
                nextBtn.style.display = currentCardIndex + cardToShow >= cards.length ? 'block' : 'block';
            }

            function nextSlide() {
                if (currentCardIndex + cardToShow < cards.length) {
                    currentCardIndex += 1;
                    showCards();
                    updateButtons();
                }
            }

            function prevSlide() {
                if (currentCardIndex > 0) {
                    currentCardIndex -= 1;
                    showCards();
                    updateButtons();
                }
            }

            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);

            showCards();
            updateButtons();
        });
        // function showReviews(button) {
        //     var reviewsButton = button;
        //     var customerReviews = document.getElementById('customerReviews');
        //     var movieDescription = document.getElementById('movieDescription');

        //     if (customerReviews.style.display === 'block') {
        //         console.log("11111111111");
        //         reviewsButton.textContent = 'Xem giới thiệu';
        //         movieDescription.style.display = 'block';
        //         customerReviews.style.display = 'none';
        //     } else {
        //         console.log("22222222222");
        //         reviewsButton.textContent = 'Xem đánh giá';
        //         customerReviews.style.display = 'block';
        //         movieDescription.style.display = 'none';
        //     }
        // }
    </script>
@endsection
