<?php
include("templates/header.php");
?>
<!-- ========================= Main ==================== -->
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
        </div>

        <div class="search">
            <label>
                <input type="text" placeholder="Search here">
                <ion-icon name="search-outline"></ion-icon>
            </label>
        </div>

        <div class="user">
            <img src="assets/imgs/customer01.jpg" alt="">
        </div>
    </div>

    <!-- ======================= Cards ================== -->
    <div class="cardBox">

        <div class="card">
            <div>
                <div class="numbers">80</div>
                <div class="cardName">Tanggapans</div>
            </div>

            <div class="iconBx">
                <ion-icon name="mail-open-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">284</div>
                <div class="cardName">Aduan</div>
            </div>

            <div class="iconBx">
                <ion-icon name="chatbubbles-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">842</div>
                <div class="cardName">User</div>
            </div>

            <div class="iconBx">
                <ion-icon name="people-outline"></ion-icon>
            </div>
        </div>
    </div>

    <!-- ================ Order Details List ================= -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Aduan Terbaru</h2>
                <a href="#" class="btn">View All</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Laporan</td>
                        <td>foto</td>
                        <td>Status</td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Eddo</td>
                        <td>$1200</td>
                        <td>img</td>
                        <td><span class="status delivered">Delivered</span></td>
                    </tr>

                    <tr>
                        <td>Dava</td>
                        <td>$110</td>
                        <td>img</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>

                    <tr>
                        <td>Alfarisi</td>
                        <td>$1200</td>
                        <td>img</td>
                        <td><span class="status return">Return</span></td>
                    </tr>

                    <tr>
                        <td>Fathur</td>
                        <td>$620</td>
                        <td>img</td>
                        <td><span class="status inProgress">In Progress</span></td>
                    </tr>

                    <tr>
                        <td>Rozak</td>
                        <td>$1200</td>
                        <td>img</td>
                        <td><span class="status delivered">Delivered</span></td>
                    </tr>

                    <tr>
                        <td>AL-Qoroni</td>
                        <td>$110</td>
                        <td>img</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>

                    <tr>
                        <td>Syahrul</td>
                        <td>$1200</td>
                        <td>img</td>
                        <td><span class="status return">Return</span></td>
                    </tr>

                    <tr>
                        <td>Faroh</td>
                        <td>$620</td>
                        <td>img</td>
                        <td><span class="status inProgress">In Progress</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- ================= New Customers ================ -->
        <div class="recentCustomers">
            <div class="cardHeader">
                <h2>Recent Customers</h2>
            </div>

            <table>
                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="../../img/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>David <br> <span>Italy</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="../../img/customer01.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Amit <br> <span>India</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="../../img/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>David <br> <span>Italy</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="../../img/customer01.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Amit <br> <span>India</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="../../img/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>David <br> <span>Italy</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="../../img/customer01.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Amit <br> <span>India</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="../../img/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>David <br> <span>Italy</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="../../img/customer01.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Amit <br> <span>India</span></h4>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
<?php
include("templates/footer.php");
?>