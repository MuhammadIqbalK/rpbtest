<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>up rpb</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <body class="dark:bg-gray-900 antialiased">
        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif
        <div class="md:container md:mx-auto">
            <div class="flex justify-center">    
        <form action="{{ route('rpb.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
            <input 
            class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            type="file" name="upld_deploy">
            <button class="inline-block rounded border border-indigo-600 bg-indigo-600 px-6 py-2 text-xs font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
            type="submit">Upload</button>
        </form>

        {{-- <table>
            <thead>
                <th>ID IHLD</th>
                <th>PROJECT DESC</th>
            </thead>
            @foreach ($rpbs as $rpb)
            <tbody>
                <td>{{ $rpb -> ID_IHLD }}</td>
                <td>{{ $rpb -> PROJECT_DESC }}</td>
            </tbody>
            @endforeach
        </table> --}}
  </body>
    </div>
  </div>
</html>