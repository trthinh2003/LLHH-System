 <?php
  session_start();
  if (!isset($_SESSION['luottruycap'])) $_SESSION['luottruycap'] = 1;
  else $_SESSION['luottruycap'] += 1;
 ?>

        <!-- Phan noi dung -->
        <main class="content px-3 py-2">
          <div class="container-fluid">
            <div class="mb-3">
              <h4>Quản Trị Thông Tin</h4>
            </div>
            <div class="row">
              <div class="col-xl-6 d-flex">
                  <div class="card flex-fill border-0 illustration">
                    <div class="card-body p-0 d-flex flex-fill">
                      <div class="d-flex justify-content-center align-items-center">
                        <div class=""><img src="view/layout/assets/images/sys-avatar.png" class="img-fluid illustration-img" alt=""/>
                      </div>
                      <div class="">
                        <div class="p-2 m-1">
                          <h4>Chào mừng đến với hệ thống</h4>
                          <h5 class="mb-0"><b>Quản Lý Lịch Thực Hành</b></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Điếm số lượt truy cập -->
              <div class="col-xl-6 d-flex">
                <div class="card flex-fill border-0 illustration">
                  <div class="card-body p-0 d-flex flex-fill">
                    <div class="d-flex justify-content-center align-items-center">
                      <div class="align-self-start text-start">
                        <img src="view/layout/assets/images/view.png" class="img-fluid illustration-img" alt=""/>
                      </div>
                      <div class="text-start">
                        <div class="p-2 m-1">
                          <h4>Số người đang truy cập</h4>
                          <h3 class="mb-0">
                            <b><?php if (isset($_SESSION['luottruycap'])) echo $_SESSION['luottruycap'];?></b>
                          </h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Lịch -->
            <h4><i class="fa-regular fa-calendar-days pe-2"></i>Lịch hôm nay</h4>
            <div class="container-calendar flex">
              <div class="calendar shadow">
                <div class="month flex">
                  <div class="prev">
                    <i class="fas fa-chevron-left"></i>
                  </div>
                  <div class="content">
                    <h1 class="fw-bold"></h1>
                    <p></p>
                  </div>
                  <div class="next">
                    <i class="fas fa-chevron-right"></i>
                  </div>
                </div>

                <div class="weekdays flex">
                  <div>Chủ nhật</div>
                  <div>Hai</div>
                  <div>Ba</div>
                  <div>Tư</div>
                  <div>Năm</div>
                  <div>Sáu</div>
                  <div>Bảy</div>
                </div>

                <div class="days flex">
                  <div class="previous-day">26</div>
                  <div class="previous-day">27</div>
                  <div class="previous-day">28</div>
                  <div class="previous-day">29</div>
                  <div class="previous-day">30</div>
                  <div class="previous-day">31</div>
                  <div class="">1</div>
                  <div class="today">11</div>
                  <div class="">31</div>
                  <div class="next-days">1</div>
                  <div class="next-days">2</div>
                  <div class="next-days">3</div>
                  <div class="next-days">4</div>
                  <div class="next-days">5</div>
                </div>
              </div>
            </div>
          </div>
        </main>
        <script src="view/layout/assets/js/normalscheduleshow.js"></script>
        <a href="#" class="theme-toggle">
          <i class="fa-regular fa-moon" title="Chế độ tối"></i>
          <i class="fa-solid fa-sun" title="Chế độ sáng"></i>
        </a>