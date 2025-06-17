<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Buku</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Figtree', sans-serif;
            width: 100%;
            min-height: 100vh;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            width: 100%;
            max-width: 1800px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        h1 {
            font-size: 2.5rem;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f2f2f2;
            font-weight: 600;
            color: #333;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #3490dc;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2779bd;
        }

        .btn-warning {
            background-color: #f6993f;
            color: white;
        }

        .btn-warning:hover {
            background-color: #e58e2d;
        }

        .btn-danger {
            background-color: #e3342f;
            color: white;
        }

        .btn-danger:hover {
            background-color: #cc1f1a;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin-top: 20px;
            justify-content: center;
        }

        .pagination li {
            margin-right: 5px;
        }

        .pagination li a, .pagination li span {
            padding: 10px 15px;
            border: 1px solid #ddd;
            text-decoration: none;
            border-radius: 4px;
            color: #3490dc;
            background-color: white;
        }

        .pagination li.active span {
            background-color: #3490dc;
            color: white;
            border-color: #3490dc;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .description {
            max-width: 500px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .description {
                max-width: 200px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Manajemen Buku</h1>
            <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku Baru</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div id="books-container">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="books-table">
                    @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->year }}</td>
                        <td class="description">{{ $book->description }}</td>
                        <td>
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div id="pagination-container">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</body>
</html>

