  <!-- footer start -->
  <footer class="footer">
      <div class="container py-4">
          <div class="row">
              <div class="col-md-12 d-flex justify-content-end">
                  <div class="social-icon">
                      <span class="fb"><i class="bi bi-facebook"></i></span>
                      <span class="youtube"><i class="bi bi-youtube"></i></span>
                      <span class="twitter"><i class="bi bi-twitter"></i></span>
                  </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 footer-logo">
                  <img class="img-fluid" src="{{asset('front/img/header-logo.png')}}" alt="" />
                  <div class="footer-title my-3">
                      <p>Headquarters</p>
                  </div>
                  <div class="address">
                      <p>
                          {{$com_acc_info->c_address}} <br />
                          TEL : {{$com_acc_info->tel}} (Hotline) <br />
                          whatsapp : {{$com_acc_info->whatsup}} <br />
                          Corporate Site : {{$com_acc_info->website}} <br />
                          E-mail : {{$com_acc_info->email}}
                      </p>
                  </div>
                  <div class="mt-5 color-first-letter">
                      <ul>
                          <li>
                              <a class="nav-link" href="#">Terms of Use</a>
                          </li>
                          <li>
                              <a class="nav-link" href="#">Privacy Policy</a>
                          </li>
                          <li>
                              <a class="nav-link" href="#">Cookie Policy </a>
                          </li>
                          <li>
                              <a class="nav-link" href="#">Security export control </a>
                          </li>
                          <li>
                              <a class="nav-link" href="#">Basic Policy Against Anti-Social Forces</a>
                          </li>
                          <li>
                              <a class="nav-link" href="#">Security export control</a>
                          </li>
                          <li>
                              <a class="nav-link" href="#">Sitemap</a>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 footer-col-2">
                  <div class="footer-title">
                      <p>Today’s Deals</p>
                  </div>
                  <div class="my-3">
                      <ul class="navbar-nav">
                          <li class="nav-item">
                              <a class="nav-link" href="#">Year end offer 2022</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">ICJ Outlet Mall</a>
                          </li>
                      </ul>
                  </div>
                  <div class="footer-title">
                      <p>By Brands</p>
                  </div>
                  <div class="my-3">
                      <ul class="navbar-nav">
                          @forelse($brands as $b)
                          <li class="nav-item">
                              <a class="nav-link" href="{{route('brand',strtolower($b->name))}}">{{$b->name}}</a>
                          </li>
                          @empty
                          @endforelse
                      </ul>
                  </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
                  <div class="footer-title">
                      <p>By Prices</p>
                  </div>
                  <div class="my-3">
                      <ul>
                          @php
                          for ($i = $price_range[0]->minprice; $i <= $price_range[0]->maxprice; $i += 3000) {
                              @endphp
                              <li class="nav-item">
                                  <a class="nav-link" href="#">Under USD {{$i}} </a>
                              </li>
                              @php
                              }
                              @endphp
                      </ul>
                  </div>
                  <div class="footer-title">
                      <p>By Discount</p>
                  </div>
                  <div class="my-3">
                      <ul>
                          @php
                          for ($i = $discount_range[0]->mindis; $i <= $discount_range[0]->maxdis; $i += 10) {
                              @endphp
                              <li class="nav-item">
                                  <a class="nav-link" href="#">90%~ OFF </a>
                              </li>
                              @php
                              }
                              @endphp
                      </ul>
                  </div>
                  <div class="footer-title">
                      <p>Inventory Location</p>
                  </div>
                  <div class="my-3">
                      <ul>
                          @forelse($inv_loc as $inv)
                          <li class="nav-item">
                              <a class="nav-link" href="#">{{$inv->name}} Inventory </a>
                          </li>
                          @empty
                          @endforelse
                      </ul>
                  </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
                  <div class="footer-title">
                      <p>By Type</p>
                  </div>
                  <div class="my-3">
                      <ul>
                          @forelse($body_types as $bt)
                          <li class="nav-item">
                              <a class="nav-link" href="#">{{$bt->name}}</a>
                          </li>
                          @empty
                          @endforelse
                      </ul>
                  </div>
                  <div class="footer-title">
                      <p>By Category</p>
                  </div>
                  <div class="my-3 improtant-lint">
                      <ul>
                          @forelse($drive_types as $dt)
                          <li class="nav-item">
                              <a class="nav-link" href="#">{{$dt->name}}</a>
                          </li>
                          @empty
                          @endforelse
                      </ul>
                  </div>
                  <div class="footer-title">
                      <p>Car Contents</p>
                  </div>
                  <div class="my-3 improtant-lint">
                      <ul>
                          <li class="nav-item">
                              <a class="nav-link" href="#">Customer Reviews </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">Car Reviews</a>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3">
                  <div class="footer-title">
                      <p>Global Office</p>
                  </div>
                  <div class="my-3">
                      <ul>
                          <li class="nav-item">
                              <a class="nav-link" href="#">Asia
                                  <ul>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Bangladesh - Dhaka </a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Kyrgyzstan - Bishkek</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Mongolia - Ulaanbaatar</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Myanmar - Yangon</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Philippines - Manila</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Sri Lanka - Colombo</a>
                                      </li>
                                  </ul>
                              </a>
                          </li>
                      </ul>
                  </div>
                  <div class="footer-title">
                      <p>Authorized Retailer:</p>
                  </div>
                  <div class="my-3">
                      <ul>
                          <li class="nav-item">
                              <a class="nav-link" href="#">Asia
                                  <ul>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Bangladesh - Dhaka </a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Kyrgyzstan - Bishkek</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Mongolia - Ulaanbaatar</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Myanmar - Yangon</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Philippines - Manila</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="nav-link" href="#">Sri Lanka - Colombo</a>
                                      </li>
                                  </ul>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <!-- Signature & Copywrite -->
      <div class="copywrite text-white">
          <div class="container">
              <p>&copy ICAR JAPAN LTD.</p>
          </div>
      </div>
  </footer>
  <!-- footer end -->
  <!-- Top Scroll -->
  <div class="top-scroll">
      <a href="#"><i class="bi bi-caret-up"></i></a>
  </div>
  <!-- Bootstrap 5.3 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!-- JS -->
  <script src="./resource/js/app.js"></script>
  <!-- fb page js -->
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0&appId=425979584449354&autoLogAppEvents=1" nonce="lQcO9Eh9"></script>
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <!--begin::Page Scripts(used by this page)-->
  @stack('scripts')
  <!--end::Page Scripts-->

  </body>

  </html>