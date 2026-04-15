@extends('layouts.app')

@section('title', 'Import Clustering')

@section('content')
<div class="min-h-screen bg-gray-100">
    <nav class="bg-gray-900 text-white px-6 py-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center gap-3">
            <i class="fas fa-shield-halved text-xl"></i>
            <span class="font-bold text-lg">Tracer Study — Admin Panel</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.clustering.index') }}" class="text-gray-300 hover:text-white text-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    <i class="fas fa-right-from-bracket mr-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="p-8 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Import Data Clustering</h1>

        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">
            <h3 class="font-semibold text-blue-800 mb-2"><i class="fas fa-info-circle mr-1"></i> Format CSV</h3>
            <p class="text-blue-700 text-sm">File CSV hasil clustering dari model ML dengan kolom terakhir <strong>label_cluster</strong> (0 atau 1)</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 mb-4 text-sm">
                <i class="fas fa-circle-check mr-1"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow p-6">
            <form method="POST" action="{{ route('admin.clustering.import.post') }}" enctype="multipart/form-data">
                @csrf
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-4 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File CSV</label>
                <input type="file" name="csv_file" accept=".csv"
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm mb-4" required/>
                <button type="submit"
                        class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg transition flex items-center justify-center gap-2">
                    <i class="fas fa-upload"></i> Import Data Clustering
                </button>
            </form>
        </div>
    </div>
</div>
@endsection