<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <!--div class="booking-text-title">
                <span>Reserva</span><br>
                <span>tu Estadía</span>
            </div-->
            <img src="{$path}/images/logo_new.png" class="img-responsive" alt="" style="margin-top: 50%; -webkit-transform: translateY(-50%);-moz-transform: translateY(-50%);-ms-transform: translateY(-50%);-o-transform: translateY(-50%);transform: translateY(-50%);">
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="box-booking clearfix">
                <div class="text-booking">Reserva de hoteles</div>
                <form action="{$path}/index.php/booking" method="post" id="frmBooking">
                    <!--div class="col-lg-12 form-group">
                        <label for="cboHotel">Hotel</label>
                        <select class="form-control" name="cboHotel" id="cboHotel">
                            {foreach from=$hoteles item=h}
                                <option value="{$h.ID}">{$h.NOMBRE}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="col-lg-12 form-group">
                        <label for="cboHabitacion">Habitación</label>
                        <select class="form-control" name="cboHabitacion" id="cboHabitacion">
                        </select>
                    </div-->
                    <div class="col-lg-6 form-group">
                        <label for="txtCheckIn">Check in</label>
                        <div class="input-group date" id="checkin">
                            <input type="text" class="form-control" maxlength="10" name="txtCheckIn" id="txtCheckIn" placeholder="Entrada" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="txtCheckOut">Check out</label>
                        <div class="input-group date" id="checkout">
                            <input type="text" class="form-control" maxlength="10" name="txtCheckOut" id="txtCheckOut" placeholder="Salida" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
                    </div>
                    <div class="col-lg-4 form-group">
                        <label for="cboHabitaciones">Habitaciones</label>
                        <select class="form-control" name="cboHabitaciones" id="cboHabitaciones">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="col-lg-4 form-group">
                        <label for="cboAdultos">Adultos</label>
                        <select class="form-control" name="cboAdultos" id="cboAdultos">
                            <option>1</option>
                            <option selected>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="col-lg-4 form-group">
                        <label for="cboMenores">Menores</label>
                        <select class="form-control" name="cboMenores" id="cboMenores">
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <button type="button" id="btnReservar" class="btn btn-full-width btn-booking">RESERVAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>