<!-- NotificationBar Logic.-->

<li><a class="notifyBtn" href="">
<div class="hidden notificationBox" data-user-id="<?php echo $_SESSION['id']; ?>">
    <p class="notify-text-header">Notifications</p>
    <div class="notification-content"></div>

    <!-- <div class="notification">
      <i class="material-icons circle notify-important-icon">priority_high</i>
      <p class="notify-important-text">AyAyRon has added ..</p>
    </div> -->

    <!-- <div class="notification notification-success">
      <i class="material-icons circle notify-success-icon">done</i>
      <p>AyAyRon has added ..</p>
    </div> -->

    <!-- preloader which gets removed when notifications load. -->
    <div id="notificationLoader" class="progress">
      <div class="indeterminate"></div>
  </div>
</div>
<i class="material-icons">notifications</i></a></li>
