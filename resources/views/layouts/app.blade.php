<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('storage/favicon-bb.svg') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Boolbnb</title>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-3">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="logo_laravel">
                        <svg class="d-none d-lg-block" width="240" height="27" viewBox="0 0 240 27" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.2 26.036C16.152 26.036 16.08 26.024 15.984 26C15.888 25.976 15.792 25.928 15.696 25.856L2.016 16.604C1.68 16.364 1.416 16.136 1.224 15.92C1.056 15.704 0.972 15.416 0.972 15.056V13.76C0.972 13.376 1.056 13.076 1.224 12.86C1.416 12.644 1.68 12.428 2.016 12.212L15.696 2.924C15.792 2.876 15.888 2.84 15.984 2.816C16.08 2.792 16.152 2.78 16.2 2.78C16.416 2.78 16.596 2.852 16.74 2.996C16.884 3.116 16.956 3.284 16.956 3.5V8.36C16.956 8.792 16.836 9.116 16.596 9.332C16.356 9.548 16.116 9.728 15.876 9.872L8.82 14.408L15.876 18.98C16.116 19.1 16.356 19.268 16.596 19.484C16.836 19.676 16.956 19.988 16.956 20.42V25.28C16.956 25.52 16.884 25.712 16.74 25.856C16.596 25.976 16.416 26.036 16.2 26.036ZM224.479 26.072C224.263 26.072 224.083 26 223.939 25.856C223.795 25.712 223.723 25.532 223.723 25.316V20.456C223.723 20.024 223.843 19.712 224.083 19.52C224.347 19.304 224.587 19.124 224.803 18.98L231.895 14.408L224.803 9.872C224.587 9.752 224.347 9.584 224.083 9.368C223.843 9.128 223.723 8.804 223.723 8.396V3.536C223.723 3.32 223.795 3.14 223.939 2.996C224.083 2.852 224.263 2.78 224.479 2.78C224.551 2.78 224.623 2.804 224.695 2.852C224.791 2.876 224.887 2.912 224.983 2.96L238.699 12.248C239.035 12.464 239.287 12.68 239.455 12.896C239.647 13.112 239.743 13.4 239.743 13.76V15.092C239.743 15.452 239.647 15.74 239.455 15.956C239.287 16.172 239.035 16.388 238.699 16.604L224.983 25.892C224.887 25.94 224.791 25.976 224.695 26C224.623 26.048 224.551 26.072 224.479 26.072Z"
                                fill="#D61C4E" />
                            <path
                                d="M25.2124 26C24.9724 26 24.7564 25.916 24.5644 25.748C24.3724 25.556 24.2764 25.328 24.2764 25.064V1.736C24.2764 1.472 24.3724 1.256 24.5644 1.088C24.7564 0.895998 24.9724 0.799998 25.2124 0.799998H36.6964C38.8804 0.799998 40.6684 1.088 42.0604 1.664C43.4524 2.24 44.4844 3.068 45.1564 4.148C45.8284 5.228 46.1644 6.56 46.1644 8.144C46.1644 8.96 45.9964 9.692 45.6604 10.34C45.3484 10.964 44.9644 11.492 44.5084 11.924C44.0524 12.332 43.6204 12.632 43.2124 12.824C44.1484 13.232 44.9644 13.928 45.6604 14.912C46.3564 15.872 46.7044 16.976 46.7044 18.224C46.7044 19.904 46.3204 21.32 45.5524 22.472C44.8084 23.624 43.7164 24.5 42.2764 25.1C40.8604 25.7 39.1204 26 37.0564 26H25.2124ZM32.0164 20.564H36.2284C37.0444 20.564 37.6444 20.324 38.0284 19.844C38.4124 19.34 38.6044 18.788 38.6044 18.188C38.6044 17.564 38.4004 17.024 37.9924 16.568C37.5844 16.088 36.9964 15.848 36.2284 15.848H32.0164V20.564ZM32.0164 10.556H35.8684C36.6364 10.556 37.2004 10.34 37.5604 9.908C37.9204 9.476 38.1004 8.972 38.1004 8.396C38.1004 7.82 37.9204 7.316 37.5604 6.884C37.2004 6.452 36.6364 6.236 35.8684 6.236H32.0164V10.556ZM64.0834 26.36C61.7794 26.36 59.7754 26 58.0714 25.28C56.3914 24.56 55.0594 23.48 54.0754 22.04C53.1154 20.576 52.5994 18.764 52.5274 16.604C52.5034 15.596 52.4914 14.564 52.4914 13.508C52.4914 12.428 52.5034 11.36 52.5274 10.304C52.5994 8.168 53.1154 6.368 54.0754 4.904C55.0594 3.44 56.4034 2.336 58.1074 1.592C59.8114 0.823999 61.8034 0.439999 64.0834 0.439999C66.3394 0.439999 68.3194 0.823999 70.0234 1.592C71.7274 2.336 73.0714 3.44 74.0554 4.904C75.0394 6.368 75.5554 8.168 75.6034 10.304C75.6514 11.36 75.6754 12.428 75.6754 13.508C75.6754 14.564 75.6514 15.596 75.6034 16.604C75.5314 18.764 75.0034 20.576 74.0194 22.04C73.0594 23.48 71.7274 24.56 70.0234 25.28C68.3434 26 66.3634 26.36 64.0834 26.36ZM64.0834 20.24C65.0914 20.24 65.9194 19.94 66.5674 19.34C67.2154 18.716 67.5514 17.732 67.5754 16.388C67.6234 15.356 67.6474 14.36 67.6474 13.4C67.6474 12.416 67.6234 11.42 67.5754 10.412C67.5514 9.524 67.3834 8.792 67.0714 8.216C66.7834 7.64 66.3754 7.22 65.8474 6.956C65.3434 6.692 64.7554 6.56 64.0834 6.56C63.4114 6.56 62.8114 6.692 62.2834 6.956C61.7554 7.22 61.3354 7.64 61.0234 8.216C60.7354 8.792 60.5794 9.524 60.5554 10.412C60.5314 11.42 60.5194 12.416 60.5194 13.4C60.5194 14.36 60.5314 15.356 60.5554 16.388C60.6034 17.732 60.9394 18.716 61.5634 19.34C62.2114 19.94 63.0514 20.24 64.0834 20.24ZM93.2996 26.36C90.9956 26.36 88.9916 26 87.2876 25.28C85.6076 24.56 84.2756 23.48 83.2916 22.04C82.3316 20.576 81.8156 18.764 81.7436 16.604C81.7196 15.596 81.7076 14.564 81.7076 13.508C81.7076 12.428 81.7196 11.36 81.7436 10.304C81.8156 8.168 82.3316 6.368 83.2916 4.904C84.2756 3.44 85.6196 2.336 87.3236 1.592C89.0276 0.823999 91.0196 0.439999 93.2996 0.439999C95.5556 0.439999 97.5356 0.823999 99.2396 1.592C100.944 2.336 102.288 3.44 103.272 4.904C104.256 6.368 104.772 8.168 104.82 10.304C104.868 11.36 104.892 12.428 104.892 13.508C104.892 14.564 104.868 15.596 104.82 16.604C104.748 18.764 104.22 20.576 103.236 22.04C102.276 23.48 100.944 24.56 99.2396 25.28C97.5596 26 95.5796 26.36 93.2996 26.36ZM93.2996 20.24C94.3076 20.24 95.1356 19.94 95.7836 19.34C96.4316 18.716 96.7676 17.732 96.7916 16.388C96.8396 15.356 96.8636 14.36 96.8636 13.4C96.8636 12.416 96.8396 11.42 96.7916 10.412C96.7676 9.524 96.5996 8.792 96.2876 8.216C95.9996 7.64 95.5916 7.22 95.0636 6.956C94.5596 6.692 93.9716 6.56 93.2996 6.56C92.6276 6.56 92.0276 6.692 91.4996 6.956C90.9716 7.22 90.5516 7.64 90.2396 8.216C89.9516 8.792 89.7956 9.524 89.7716 10.412C89.7476 11.42 89.7356 12.416 89.7356 13.4C89.7356 14.36 89.7476 15.356 89.7716 16.388C89.8196 17.732 90.1556 18.716 90.7796 19.34C91.4276 19.94 92.2676 20.24 93.2996 20.24ZM112.58 26C112.34 26 112.124 25.916 111.932 25.748C111.74 25.556 111.644 25.328 111.644 25.064V1.736C111.644 1.472 111.74 1.256 111.932 1.088C112.124 0.895998 112.34 0.799998 112.58 0.799998H118.556C118.82 0.799998 119.048 0.895998 119.24 1.088C119.432 1.256 119.528 1.472 119.528 1.736V19.592H129.932C130.196 19.592 130.424 19.688 130.616 19.88C130.808 20.048 130.904 20.264 130.904 20.528V25.064C130.904 25.328 130.808 25.556 130.616 25.748C130.424 25.916 130.196 26 129.932 26H112.58Z"
                                fill="#030920" />
                            <path
                                d="M137.648 26C137.408 26 137.192 25.916 137 25.748C136.808 25.556 136.712 25.328 136.712 25.064V1.736C136.712 1.472 136.808 1.256 137 1.088C137.192 0.895998 137.408 0.799998 137.648 0.799998H149.132C151.316 0.799998 153.104 1.088 154.496 1.664C155.888 2.24 156.92 3.068 157.592 4.148C158.264 5.228 158.6 6.56 158.6 8.144C158.6 8.96 158.432 9.692 158.096 10.34C157.784 10.964 157.4 11.492 156.944 11.924C156.488 12.332 156.056 12.632 155.648 12.824C156.584 13.232 157.4 13.928 158.096 14.912C158.792 15.872 159.14 16.976 159.14 18.224C159.14 19.904 158.756 21.32 157.988 22.472C157.244 23.624 156.152 24.5 154.712 25.1C153.296 25.7 151.556 26 149.492 26H137.648ZM144.452 20.564H148.664C149.48 20.564 150.08 20.324 150.464 19.844C150.848 19.34 151.04 18.788 151.04 18.188C151.04 17.564 150.836 17.024 150.428 16.568C150.02 16.088 149.432 15.848 148.664 15.848H144.452V20.564ZM144.452 10.556H148.304C149.072 10.556 149.636 10.34 149.996 9.908C150.356 9.476 150.536 8.972 150.536 8.396C150.536 7.82 150.356 7.316 149.996 6.884C149.636 6.452 149.072 6.236 148.304 6.236H144.452V10.556ZM166.583 26C166.343 26 166.127 25.916 165.935 25.748C165.743 25.556 165.647 25.328 165.647 25.064V1.736C165.647 1.472 165.743 1.256 165.935 1.088C166.127 0.895998 166.343 0.799998 166.583 0.799998H171.371C171.803 0.799998 172.115 0.907998 172.307 1.124C172.499 1.316 172.631 1.46 172.703 1.556L180.119 13.472V1.736C180.119 1.472 180.215 1.256 180.407 1.088C180.599 0.895998 180.815 0.799998 181.055 0.799998H186.491C186.755 0.799998 186.971 0.895998 187.139 1.088C187.331 1.256 187.427 1.472 187.427 1.736V25.064C187.427 25.328 187.331 25.556 187.139 25.748C186.971 25.916 186.755 26 186.491 26H181.739C181.283 26 180.959 25.904 180.767 25.712C180.575 25.496 180.443 25.34 180.371 25.244L172.955 14.012V25.064C172.955 25.328 172.859 25.556 172.667 25.748C172.499 25.916 172.283 26 172.019 26H166.583ZM195.94 26C195.7 26 195.484 25.916 195.292 25.748C195.1 25.556 195.004 25.328 195.004 25.064V1.736C195.004 1.472 195.1 1.256 195.292 1.088C195.484 0.895998 195.7 0.799998 195.94 0.799998H207.424C209.608 0.799998 211.396 1.088 212.788 1.664C214.18 2.24 215.212 3.068 215.884 4.148C216.556 5.228 216.892 6.56 216.892 8.144C216.892 8.96 216.724 9.692 216.388 10.34C216.076 10.964 215.692 11.492 215.236 11.924C214.78 12.332 214.348 12.632 213.94 12.824C214.876 13.232 215.692 13.928 216.388 14.912C217.084 15.872 217.432 16.976 217.432 18.224C217.432 19.904 217.048 21.32 216.28 22.472C215.536 23.624 214.444 24.5 213.004 25.1C211.588 25.7 209.848 26 207.784 26H195.94ZM202.744 20.564H206.956C207.772 20.564 208.372 20.324 208.756 19.844C209.14 19.34 209.332 18.788 209.332 18.188C209.332 17.564 209.128 17.024 208.72 16.568C208.312 16.088 207.724 15.848 206.956 15.848H202.744V20.564ZM202.744 10.556H206.596C207.364 10.556 207.928 10.34 208.288 9.908C208.648 9.476 208.828 8.972 208.828 8.396C208.828 7.82 208.648 7.316 208.288 6.884C207.928 6.452 207.364 6.236 206.596 6.236H202.744V10.556Z"
                                fill="#1CD6CE" />
                        </svg>
                        <svg class="d-lg-none" width="132" height="35" viewBox="0 0 132 35" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.8485 34.2907C20.7834 34.2907 20.6857 34.2744 20.5554 34.2418C20.4252 34.2093 20.2949 34.1441 20.1646 34.0464L1.60221 21.4924C1.1463 21.1667 0.788073 20.8573 0.527548 20.5642C0.299588 20.2712 0.185608 19.8804 0.185608 19.3919V17.6333C0.185608 17.1123 0.299588 16.7052 0.527548 16.4121C0.788073 16.119 1.1463 15.8259 1.60221 15.5329L20.1646 2.92994C20.2949 2.86481 20.4252 2.81596 20.5554 2.78339C20.6857 2.75083 20.7834 2.73455 20.8485 2.73455C21.1416 2.73455 21.3859 2.83224 21.5812 3.02764C21.7766 3.19047 21.8743 3.41843 21.8743 3.71152V10.3061C21.8743 10.8922 21.7115 11.3319 21.3859 11.625C21.0602 11.9181 20.7345 12.1623 20.4089 12.3577L10.8346 18.5126L20.4089 24.7164C20.7345 24.8792 21.0602 25.1072 21.3859 25.4002C21.7115 25.6608 21.8743 26.0841 21.8743 26.6703V33.2649C21.8743 33.5905 21.7766 33.851 21.5812 34.0464C21.3859 34.2093 21.1416 34.2907 20.8485 34.2907ZM111.064 34.3395C110.771 34.3395 110.527 34.2418 110.331 34.0464C110.136 33.851 110.038 33.6068 110.038 33.3137V26.7192C110.038 26.133 110.201 25.7096 110.527 25.4491C110.885 25.156 111.211 24.9118 111.504 24.7164L121.127 18.5126L111.504 12.3577C111.211 12.1949 110.885 11.9669 110.527 11.6738C110.201 11.3482 110.038 10.9085 110.038 10.3549V3.76037C110.038 3.46728 110.136 3.22303 110.331 3.02764C110.527 2.83224 110.771 2.73455 111.064 2.73455C111.162 2.73455 111.259 2.76711 111.357 2.83225C111.487 2.86481 111.618 2.91366 111.748 2.97879L130.359 15.5817C130.815 15.8748 131.157 16.1679 131.385 16.461C131.646 16.7541 131.776 17.1449 131.776 17.6333V19.4407C131.776 19.9292 131.646 20.32 131.385 20.6131C131.157 20.9062 130.815 21.1993 130.359 21.4924L111.748 34.0953C111.618 34.1604 111.487 34.2093 111.357 34.2418C111.259 34.307 111.162 34.3395 111.064 34.3395Z"
                                fill="#D61C4E" />
                            <path
                                d="M33.0774 34.2418C32.7518 34.2418 32.4587 34.1278 32.1982 33.8999C31.9376 33.6394 31.8074 33.33 31.8074 32.9718V1.31794C31.8074 0.959718 31.9376 0.666627 32.1982 0.438669C32.4587 0.178143 32.7518 0.0478801 33.0774 0.0478801H48.6601C51.6236 0.0478801 54.0497 0.438668 55.9385 1.22024C57.8273 2.00182 59.2277 3.12534 60.1395 4.59079C61.0513 6.05624 61.5072 7.86364 61.5072 10.013C61.5072 11.1202 61.2793 12.1135 60.8234 12.9927C60.4 13.8394 59.879 14.5559 59.2602 15.1421C58.6415 15.6957 58.0553 16.1028 57.5017 16.3633C58.7717 16.9169 59.879 17.8613 60.8234 19.1965C61.7678 20.4991 62.24 21.9971 62.24 23.6905C62.24 25.9701 61.7189 27.8915 60.6768 29.4547C59.6673 31.0178 58.1856 32.2065 56.2316 33.0206C54.3102 33.8348 51.9492 34.2418 49.1486 34.2418H33.0774ZM42.3098 26.8657H48.0251C49.1323 26.8657 49.9464 26.54 50.4675 25.8887C50.9885 25.2049 51.2491 24.4558 51.2491 23.6417C51.2491 22.795 50.9723 22.0623 50.4186 21.4435C49.865 20.7922 49.0672 20.4665 48.0251 20.4665H42.3098V26.8657ZM42.3098 13.2858H47.5366C48.5787 13.2858 49.344 12.9927 49.8325 12.4065C50.3209 11.8204 50.5652 11.1365 50.5652 10.3549C50.5652 9.57334 50.3209 8.88946 49.8325 8.30328C49.344 7.71709 48.5787 7.424 47.5366 7.424H42.3098V13.2858Z"
                                fill="#030920" />
                            <path
                                d="M72.3394 34.2418C72.0137 34.2418 71.7207 34.1278 71.4601 33.8999C71.1996 33.6394 71.0693 33.33 71.0693 32.9718V1.31794C71.0693 0.959718 71.1996 0.666627 71.4601 0.438669C71.7207 0.178143 72.0137 0.0478801 72.3394 0.0478801H87.9221C90.8855 0.0478801 93.3117 0.438668 95.2005 1.22024C97.0893 2.00182 98.4896 3.12534 99.4015 4.59079C100.313 6.05624 100.769 7.86364 100.769 10.013C100.769 11.1202 100.541 12.1135 100.085 12.9927C99.662 13.8394 99.1409 14.5559 98.5222 15.1421C97.9034 15.6957 97.3173 16.1028 96.7636 16.3633C98.0337 16.9169 99.1409 17.8613 100.085 19.1965C101.03 20.4991 101.502 21.9971 101.502 23.6905C101.502 25.9701 100.981 27.8915 99.9388 29.4547C98.9293 31.0178 97.4475 32.2065 95.4936 33.0206C93.5722 33.8348 91.2112 34.2418 88.4106 34.2418H72.3394ZM81.5718 26.8657H87.287C88.3943 26.8657 89.2084 26.54 89.7295 25.8887C90.2505 25.2049 90.511 24.4558 90.511 23.6417C90.511 22.795 90.2342 22.0623 89.6806 21.4435C89.127 20.7922 88.3291 20.4665 87.287 20.4665H81.5718V26.8657ZM81.5718 13.2858H86.7986C87.8407 13.2858 88.6059 12.9927 89.0944 12.4065C89.5829 11.8204 89.8272 11.1365 89.8272 10.3549C89.8272 9.57334 89.5829 8.88946 89.0944 8.30328C88.6059 7.71709 87.8407 7.424 86.7986 7.424H81.5718V13.2858Z"
                                fill="#16C0B9" />
                        </svg>
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-user"></i>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>
