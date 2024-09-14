<!DOCTYPE html>
<html class="h-full bg-white html">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />
      <title>Barta || Social Media App</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link
      rel="preconnect"
      href="https://fonts.googleapis.com" />
    <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet" />

    <style>
      * {
        font-family: 'Inter', sans-serif;
      }
    </style>
  </head>
  <body class="h-full">
    <div class="flex flex-col justify-center min-h-full px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <a
          href="{{ route('home') }}"
          class="text-6xl font-bold text-center text-gray-900"
          ><h1>Barta</h1></a
        >

        <h1
          class="mt-10 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">
          {{ $heading }}
        </h1>
      </div>

      {{ $slot }}
    </div>
  </body>
</html>
