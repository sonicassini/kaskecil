<link href="gg.css" type="text/css" rel="stylesheet" />
<form action="test.html" method="post">
    <h1>Form Pendaftaran</h1>

    <fieldset id="UserDataFields">
        <legend>Data pengguna (wajib diisikan seluruhnya)</legend>

        <div class="control-group">
            <label for="Register[Username]">Nama Pengguna</label>
            <input type="text"
                   name="Register[Username]"
                   id="RegisterUsername" required>
        </div>

        <div class="control-group">
            <label for="Register[Password]">Password</label>
            <input type="password"
                   name="Register[Password]"
                   id="RegisterPassword" required>
        </div>

        <div class="control-group">
            <label for="Register[PasswordConfirm]">
                Konfirmasi Password
            </label>
            <input type="password"
                   name="Register[PasswordConfirm]"
                   id="RegisterPasswordConfirm" required>
        </div>

        <div class="control-group">
            <label for="Register[Email]">Email</label>
            <input type="email"
                   name="Register[Email]"
                   id="RegisterEmail" required>
        </div>
    </fieldset>

    <fieldset id="SelfInfo">
        <legend>Data diri</legend>

        <div class="control-group">
            <label for="Register[Sex]">Jenis Kelamin</label>
            <select id="RegisterSex" name="Register[Sex]">
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
            </select>
        </div>

        <div class="control-group">
            <label for="Register[Birthday]">Tanggal Lahir</label>
            <input type="datetime-local"
                   name="Register[Birthday]"
                   id="RegisterBirthday]">
        </div>
    </fieldset>

    <fieldset id="FormAction">
        <legend>Selesai mengisikan form?</legend>

        <input type="reset" value="Hapus Form">
        <input type="submit" value="Daftar">
    </fieldset>
</form>