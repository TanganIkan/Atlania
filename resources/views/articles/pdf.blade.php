<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $article->title }}</title>
    <style>
        @page {
            margin: 1cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            line-height: 1.6;
            color: #1a1c2e;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 100%;
        }

        .category-tag {
            text-align: center;
            text-transform: uppercase;
            font-size: 10px;
            font-weight: bold;
            color: #f15a24;
            margin-bottom: 5px;
            letter-spacing: 1.5px;
        }

        h1 {
            font-size: 26px;
            font-weight: bold;
            text-align: center;
            margin-top: 0;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .meta {
            text-align: center;
            font-size: 10px;
            color: #64748b;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        .featured-image-container {
            width: 100%;
            margin-bottom: 25px;
            text-align: center;
        }

        .featured-image {
            width: 100%;
            max-width: 100%;
            height: auto;
            border-radius: 12px;
        }

        hr {
            border: 0;
            border-top: 1px solid #e2e8f0;
            margin: 25px 0;
        }

        .content {
            font-size: 12px;
            color: #334155;
            text-align: justify;
            white-space: normal;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            border-top: 1px solid #f1f5f9;
            padding-top: 10px;
            font-size: 8px;
            color: #94a3b8;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="category-tag">— {{ $article->category->name }}</div>

        <h1>{{ $article->title }}</h1>

        <div class="meta">
            By <strong>{{ $article->user->name }}</strong>
            <span> • </span>
            {{ $article->created_at->format('d F Y') }}
        </div>
        <hr>

        <div class="content">
            {{-- Menggunakan nl2br agar paragraf dari content tetap terjaga formatnya --}}
            {!! nl2br(e($article->content)) !!}
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Atlania Blog — Artikel ini diterbitkan oleh {{ $article->user->name }}
        </div>
    </div>
</body>

</html>