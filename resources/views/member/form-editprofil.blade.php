<div id="EditProfil">
    <form class="form-horizontal m-t-4" name="formEditProfil" id="formEditProfil" action=""  method="POST">
        <div class="form-group">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" aria-describedby="name" autocomplete="off" placeholder="name" value="{{Auth::user()->name}}" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" aria-describedby="username" autocomplete="off" placeholder="username" value="{{Auth::user()->username}}" required>
        </div>
        <div class="form-group">
            <label for="email">E-Mail</label>
                <input type="text" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="telepon">Telepon/WA</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="{{Auth::user()->telepon}}" autocomplete="off">
        </div>
        <div class="form-group">
            <span id="member_error" class="text-danger"></span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success waves-effect" id="UpdateProfil" name="UpdateProfil">UPDATE</button>
        </div>
    </form>
</div>
