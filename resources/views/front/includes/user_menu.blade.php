<style>
    #navcontainer {
        margin-bottom: 1em;
        overflow: hidden;
    }

    #navlist {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    #navlist li {
        border-left: 2px solid #adb5bd;
        float: left;
        line-height: 1.1em;
        margin: 0 .5em 0 -.5em;
        padding: 0 .5em 0 .5em;
        font-size: 17px;
        font-weight: 500;
    }
</style>
<section class="py-4 py-md-10">
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-12 d-flex justify-content-center text-center" align="center">
                <div id="navcontainer">
                    <ul id="navlist">
                        <li id="active"><a href="{{ route('user.profile') }}">My profile</a></li>
                        @if(Auth::user()->role_id == 2)
                            <li><a href="{{ route('user.contacts') }}">Customer Contacts</a></li>
                        @elseif(Auth::user()->role_id == 3)
                            <li><a href="{{ route('user.appointments') }}">My Appointments</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>