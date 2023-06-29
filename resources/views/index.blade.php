<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Location : </h1>

    <ul>
        <li>Latitude : <span id="latitude_value"></span></li>
        <li>Longitude : <span id="longitude_value"></span></li>
        <li>Data Location : <span id="location">{{ $address }}</span></li>
    </ul>
    <form action="/send-location" method="post" onsubmit="return (cekPermission(event)== true ? true : false)">
        @csrf
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <button type="submit">Submit</button>
    </form>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
    integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    // Cek apakah browser mendukung geolocation
    $(document).ready(function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                document.getElementById('latitude_value').innerHTML = latitude;
                document.getElementById('longitude_value').innerHTML = longitude;
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;


                
                // Kirim data lokasi ke server menggunakan permintaan HTTP (Ajax)
                // Contoh menggunakan library Axios
                // axios.post('/send-location', {
                //   latitude: latitude,
                //   longitude: longitude
                // })
                // .then(function (response) {
                //   console.log(response.data);
                //   document.getElementById('latitude').innerHTML = latitude;
                //   document.getElementById('longitude').innerHTML = longitude;
                //   document.getElementById('location').innerHTML = response.data.address;
                // })
                // .catch(function (error) {
                //   console.error(error);
                // });

                // $.ajax({
                //     url: '/send-location',
                //     dataType: "json",
                //     type: "Post",
                //     async: true,
                //     data: {
                //       latitude: latitude,
                //       longitude: longitude
                //     },
                //     success: function (response) {
                //       console.log(response);
                //       document.getElementById('latitude').innerHTML = latitude;
                //       document.getElementById('longitude').innerHTML = longitude;
                //       document.getElementById('location').innerHTML = response.address;
                //     },
                //     error: function (xhr, exception) {
                //         var msg = "";
                //         if (xhr.status === 0) {
                //             msg = "Not connect.\n Verify Network." + xhr.responseText;
                //         } else if (xhr.status == 404) {
                //             msg = "Requested page not found. [404]" + xhr.responseText;
                //         } else if (xhr.status == 500) {
                //             msg = "Internal Server Error [500]." +  xhr.responseText;
                //         } else if (exception === "parsererror") {
                //             msg = "Requested JSON parse failed.";
                //         } else if (exception === "timeout") {
                //             msg = "Time out error." + xhr.responseText;
                //         } else if (exception === "abort") {
                //             msg = "Ajax request aborted.";
                //         } else {
                //             msg = "Error:" + xhr.status + " " + xhr.responseText;
                //         }

                //     }
                // }); 
            });
        } else {
            console.error('Geolocation is not supported by this browser.');
            alert('Geolocation is not supported by this browser.');
        }
    })

    async function cekPermission(event){
      const permissionStatus = await navigator?.permissions?.query({name: 'geolocation'})
      const hasPermission = permissionStatus?.state // Dynamic value
      console.log(hasPermission);
      if (hasPermission === 'granted') {
        return true;
      }else if (hasPermission === 'prompt') {
        return true;
      }else if (hasPermission === 'denied') {
        alert('Please allow location access for this site')
        return false;
      }
    }
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</html>
