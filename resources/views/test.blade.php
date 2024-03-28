<link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
/>

<style>
    a.float-button {
        text-decoration: none;
        background-color: rgb(52, 212, 79);
        color: #fff;
        padding: 10px 20px;
        border-radius: 20px;
        position: fixed;
        bottom: 20px;
        right: 20px;
        box-shadow: 4px 4px 4px 1px rgba(0, 0, 0, 0.1);
        font-size:18px;
        font-weight:700;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        z-index:999999999;
    }
    a.float-button > i{
        font-size: 22px;
        position: relative;
        top: 3px;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.1/jquery.min.js"></script>


<a href="tel:+442034881842" class="float-button"><i class="fa fa-phone"></i> 02034881842</a>
<script>
    let tel = $('a[href^="tel:"]')
    let globalLatitude
    let globalLongitude
    let globalCity
    let globalPostal
    let globalGPSLatitude
    let globalGPSLongitude
    const userAgent = navigator.userAgent;
    const currentUrl = window.location.href;
    async function myFunction () {
        /* Get user country from api */
        const res = await fetch('https://ipapi.co/json')
        /* Store data as json */
        const data = await res.json()
        /* Store country in a variable */
        globalLatitude = data.latitude
        globalLongitude = data.longitude
        globalCity = data.city
        globalPostal = data.postal
    }
    myFunction ()
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
    const getDeviceType = () => {
        const ua = navigator.userAgent;
        if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
            return "tablet";
        }
        if (
            /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(
                ua
            )
        ) {
            return "mobile";
        }
        return "desktop";
    };

    tel.click(function (e) {
        // e.preventDefault();
        tel = $(this).text();
        $.ajax({
            type: "POST",
            url: "https://www.gripelectric.net/report/clicks",
            data: { count: 1, url: currentUrl, latitude: globalLatitude, longitude: globalLongitude, city: globalCity, postal: globalPostal, gpslongitude: globalGPSLongitude, gpslatitude: globalGPSLatitude, browser: userAgent, device: getDeviceType(), tel: tel  },
            success: function (response) {
                console.log(response);
            }
        });
    });
    function showPosition(position) {
        globalGPSLatitude = position.coords.latitude;
        globalGPSLongitude = position.coords.longitude;
    }
</script>