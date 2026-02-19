<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会社一覧</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background: #f5f5f5;
        }
    </style>
</head>
<body>

<h1>会社一覧</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>会社名</th>
            <th>住所</th>
            <th>代表者</th>
            <th>作成日</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->company_name }}</td>
                <td>{{ $company->street_address }}</td>
                <td>{{ $company->representative_name }}</td>
                <td>{{ $company->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>