

<div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">

    <!-- sidebar content -->
    <div class="flex flex-col">

        <!-- sidebar toggle -->
        <div class="text-right hidden md:block mb-4">
            <button id="sideBarHideBtn">
                <i class="fad fa-times-circle"></i>
            </button>
        </div>
        <!-- end sidebar toggle -->

         <!-- link -->
        <a href="/" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-chart-pie  mr-2"></i>
            Home
        </a>
        <hr>

        @can('view appointments')

        <!-- link -->
        <a href="./index.html" class="mb-3 mt-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-calendar-alt  mr-2"></i>
            Appointments
        </a>
        <hr>
         <!-- end link -->
        @endcan
        @can('view doctor')

        <!-- link -->
        <a href="{{route('doctors.index')}}" class="mb-3 mt-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-user-md  mr-2"></i>
            Doctors
        </a>
        <hr>

        @endcan
        @can('view patients')

        <!-- end link -->
        <!-- link -->
        <a href="./index-1.html" class="mb-3 mt-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-users-medical  mr-2"></i>
            Patients
        </a>
        <hr>
        <!-- end link -->
        @endcan
        @can('view ehr records')
            <!-- link -->
            <a href="./index-1.html" class="mb-3 mt-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-laptop-medical mr-2"></i>
                EHR records
            </a>
            <hr>
        @endcan
        <!-- end link -->
     </div>
    <!-- end sidebar content -->

</div>
