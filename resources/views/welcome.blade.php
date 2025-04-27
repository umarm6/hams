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
                    <p class="text-blue-100 text-xl md:text-2xl leading-snug mt-4">Welcome to the Dentist Office of Dr. Thomas
                        Dooley,
                        where
                        trust
                        and comfort are priorities.</p>
                    <a href="#" class="px-8 py-4 bg-teal-500 text-white rounded inline-block mt-8 font-semibold">Book
                        Appointment</a>
                </div>
            </div>
        </section>
    </div>
    <!-- end hero -->

    <section class="relative px-4 py-16 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 lg:py-32">
        <div class="flex flex-col lg:flex-row lg:-mx-8">
            <div class=" w-1/3 mx-auto bg-gray-200/40 p-5 border rounded ">
                <h2 class="text-3xl text-center leading-tight font-bold mt-4">Search the Doctor </h2>

                <form type="get" action="{{route('doctors.search')}}">
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


   {{-- <!-- start about -->
    <section class="relative px-4 py-16 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 lg:py-32">
        <div class="flex flex-col lg:flex-row lg:-mx-8">
            <div class="w-full lg:w-1/2 lg:px-8">
                <h2 class="text-3xl leading-tight font-bold mt-4">Welcome to the Dentist Office of Dr. Thomas Dooley</h2>
                <p class="text-lg mt-4 font-semibold">Excellence in Dentistry in the Heart of NY</p>
                <p class="mt-2 leading-relaxed">Donec convallis sollicitudin facilisis. Integer nisl ligula, accumsan non
                    tincidunt ac, imperdiet in enim.
                    Donec efficitur ullamcorper metus, eu venenatis nunc. Nam eget neque tempus, mollis sem a, faucibus mi.</p>
            </div>

            <div class="w-full lg:w-1/2 lg:px-8 mt-12 lg:mt-0">
                <div class="md:flex">
                    <div>
                        <div class="w-16 h-16 bg-blue-600 rounded-full"></div>
                    </div>
                    <div class="md:ml-8 mt-4 md:mt-0">
                        <h4 class="text-xl font-bold leading-tight">Everything You Need Under One Roof</h4>
                        <p class="mt-2 leading-relaxed">Our comprehensive services allow you to receive all needed dental care
                            right here in our state-of-art
                            office – from dental cleanings and fillings to dental implants and extractions.</p>
                    </div>
                </div>

                <div class="md:flex mt-8">
                    <div>
                        <div class="w-16 h-16 bg-blue-600 rounded-full"></div>
                    </div>
                    <div class="md:ml-8 mt-4 md:mt-0">
                        <h4 class="text-xl font-bold leading-tight">Our Patient-Focused Approach</h4>
                        <p class="mt-2 leading-relaxed">Your treatment plan will perfectly match your needs, lifestyle, and goals.
                            Even if it’s been years
                            since you last visited the dentist, we can help. Our comfortable office, compassionate team, and
                            minimally-invasive treatments will help you feel completely at ease.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:flex md:flex-wrap mt-24 text-center md:-mx-4">
            <div class="md:w-1/2 md:px-4 lg:w-1/4">
                <div class="bg-white rounded-lg border border-gray-300 p-8">
                    <img src="images/teeth-whitening.svg" alt="" class="h-20 mx-auto">

                    <h4 class="text-xl font-bold mt-4">Teeth Whitening</h4>
                    <p class="mt-1">Let us show you how our experience.</p>
                    <a href="#" class="block mt-4">Read More</a>
                </div>
            </div>

            <div class="md:w-1/2 md:px-4 mt-4 md:mt-0 lg:w-1/4">
                <div class="bg-white rounded-lg border border-gray-300 p-8">
                    <img src="images/oral-surgery.svg" alt="" class="h-20 mx-auto">

                    <h4 class="text-xl font-bold mt-4">Oral Surgery</h4>
                    <p class="mt-1">Let us show you how our experience.</p>
                    <a href="#" class="block mt-4">Read More</a>
                </div>
            </div>

            <div class="md:w-1/2 md:px-4 mt-4 md:mt-8 lg:mt-0 lg:w-1/4">
                <div class="bg-white rounded-lg border border-gray-300 p-8">
                    <img src="images/painless-dentistry.svg" alt="" class="h-20 mx-auto">

                    <h4 class="text-xl font-bold mt-4">Painless Dentistry</h4>
                    <p class="mt-1">Let us show you how our experience.</p>
                    <a href="#" class="block mt-4">Read More</a>
                </div>
            </div>

            <div class="md:w-1/2 md:px-4 mt-4 md:mt-8 lg:mt-0 lg:w-1/4">
                <div class="bg-white rounded-lg border border-gray-300 p-8">
                    <img src="images/periodontics.svg" alt="" class="h-20 mx-auto">

                    <h4 class="text-xl font-bold mt-4">Periodontics</h4>
                    <p class="mt-1">Let us show you how our experience.</p>
                    <a href="#" class="block mt-4">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end about -->

    <!-- start testimonials -->
    <section class="relative bg-gray-100 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-16 lg:py-32">
        <div class="flex flex-col lg:flex-row lg:-mx-8">
            <div class="w-full lg:w-1/2 lg:px-8">
                <h2 class="text-3xl leading-tight font-bold mt-4">Why choose the Mesothelioma Center?</h2>
                <p class="mt-2 leading-relaxed">Aenean ut tellus tellus. Suspendisse potenti. Nullam tincidunt lacus tellus,
                    sed aliquam est vehicula a. Pellentesque consectetur condimentum nulla, eleifend condimentum purus vehicula
                    in. Donec convallis sollicitudin facilisis. Integer nisl ligula, accumsan non tincidunt ac, imperdiet in
                    enim. Donec efficitur ullamcorper metus, eu venenatis nunc. Nam eget neque tempus, mollis sem a, faucibus
                    mi.</p>
            </div>

            <div class="w-full md:max-w-md md:mx-auto lg:w-1/2 lg:px-8 mt-12 mt:md-0">
                <div class="bg-gray-400 w-full h-72 rounded-lg"></div>

                <p class="italic text-sm mt-2 text-center">Aenean ante nisi, gravida non mattis semper.</p>
            </div>
        </div>
    </section>
    <!-- end testimonials -->

    <!-- start blog -->
    <section class="relative bg-white px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-32">
        <div class="">
            <h2 class="text-3xl leading-tight font-bold">Health Blog</h2>
            <p class="text-gray-600 mt-2 md:max-w-lg">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                turpis egestas.</p>

            <a href="#" title="" class="inline-block text-teal-500 font-semibold mt-6 mt:md-0">View All Posts</a>
        </div>

        <div class="md:flex mt-12 md:-mx-4">
            <div class="md:px-4 md:w-1/2 xl:w-1/4">
                <div class="bg-white rounded border border-gray-300">
                    <div class="w-full h-48 overflow-hidden bg-gray-300"></div>
                    <div class="p-4">
                        <div class="flex items-center text-sm">
                            <span class="text-teal-500 font-semibold">Business</span>
                            <span class="ml-4 text-gray-600">29 Nov, 2019</span>
                        </div>
                        <p class="text-lg font-semibold leading-tight mt-4">Card Title</p>
                        <p class="text-gray-600 mt-1">This card has supporting text below as a natural lead-in to additional content.
                        </p>
                        <div class="flex items-center mt-4">
                            <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-300"></div>
                            <div class="ml-4">
                                <p class="text-gray-600">By <span class="text-gray-900 font-semibold">Abby Sims</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:px-4 md:w-1/2 xl:w-1/4 mt-4 md:mt-0">
                <div class="bg-white rounded border border-gray-300 ">
                    <div class="w-full h-48 overflow-hidden bg-gray-300"></div>
                    <div class="p-4">
                        <div class="flex items-center text-sm">
                            <span class="text-teal-500 font-semibold">Business</span>
                            <span class="ml-4 text-gray-600">29 Nov, 2019</span>
                        </div>
                        <p class="text-lg font-semibold leading-tight mt-4">Card Title</p>
                        <p class="text-gray-600 mt-1">This card has supporting text below as a natural lead-in to additional
                            content.
                        </p>
                        <div class="flex items-center mt-4">
                            <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-300"></div>
                            <div class="ml-4">
                                <p class="text-gray-600">By <span class="text-gray-900 font-semibold">Abby Sims</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end blog -->--}}

    <!-- start footer -->
    @include('layouts.footer')
    <!-- end footer -->

</main>
</body>

</html>
