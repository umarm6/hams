<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.sass','resources/css/homepage.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-white font-sans text-gray-900">

<main class="w-full">

    <!-- start header -->
    @include('layouts.header',[
    'textColor'=>'white'
])
    <!-- end header -->

    <!-- start hero -->
    <div class="bg-gray-100">
        <section class="cover bg-blue-teal-gradient relative bg-blue-600 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 overflow-hidden py-48 flex
      items-center min-h-screen">
            <div class="h-full absolute top-0 left-0 z-0">
                <img src="{{asset('/images/cover-bg.jpg')}}" alt="" class="w-full h-full object-cover opacity-20">
            </div>

            <div class="lg:w-3/4 xl:w-2/4 relative z-10 h-100 lg:mt-16">
                <div>
                    <h1 class="text-white text-4xl md:text-5xl xl:text-6xl font-bold leading-tight">A better life starts with a
                        beautiful
                        smile.</h1>
                    <p class="text-blue-100 text-xl md:text-2xl leading-snug mt-4">Welcome to the HAMS</p>
                    <a href="#appointment" class="px-8 py-4 bg-teal-500 text-white rounded inline-block mt-8 font-semibold">Book
                        Appointment</a>
                </div>
            </div>
        </section>
    </div>
    <!-- end hero -->

    <section class="relative px-4 py-16 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 lg:py-32" id="appointment">
        <div class="flex flex-col lg:flex-row lg:-mx-8">
            <div class=" w-1/3 mx-auto bg-gray-200/40 p-5 border rounded ">
                <h2 class="text-3xl text-center leading-tight font-bold mt-4">Search the Doctor </h2>

                <form type="get" action="{{route('doctors.search')}}" >
                    <div class="flex flex-wrap mt-5">
                        <div class=" w-full px-4">
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="doctor">
                                    Doctors
                                </label>
                                <select required  name="doctor" id="doctor" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" >
                                    <option value=""> Select a Doctor</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{$doctor['id']}}"> {{$doctor['full_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        </div>
                    <div class="flex flex-wrap mt-3">
                    <div class="w-full px-4">
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="date">
                                    Date
                                </label>
                                <input type="date" min="today" onfocus="this.min=new Date().toISOString().split('T')[0]"  required name="date" id="date" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap mt-3">
                    <div class="w-6/12 px-4">
                        <button type="submit" class="bg-teal-500 btn text-white"> Search</button>
                    </div>
                    </div>

                    <x-input-error messages="{{$errors->first()}}" class="mt-2"/>
                </form>
            </div>

        </div>
    </section>

    <!-- start footer -->
    @include('layouts.footer')
    <!-- end footer -->

</main>
</body>

</html>
