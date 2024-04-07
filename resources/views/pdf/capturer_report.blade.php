<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/app.css">
    <title>Document</title>
</head>
<style>
    table,
    td,
    th {
        border: 1px solid gray;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .text-left {
        text-align: left;
    }

    .text-center {
        text-align: center;
    }

    .py-3 {
        padding-top: 6px;
        padding-bottom: 6px;
    }

    .py-4 {
        padding-top: 8px;
        padding-bottom: 8px;
    }

    .px-6 {
        padding-left: 12px;
        padding-right: 12px;
    }
</style>

<body>
    <table>
        <thead>
            <tr>
                <th class="px-6 py-3 text-left">
                    ID
                </th>
                <th class="px-6 py-3 text-left">
                    Nombre
                </th>
                <th class="px-6 py-3 text-left">
                    Teléfono
                </th>
                <th class="px-6 py-3 text-center"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($forms as $form) <tr>
                <td class="px-6 py-4 text-left">{{ $form->id }}</td>
                <td class="px-6 py-4 text-left">{{ $form->first_name
                    }} {{ $form->second_name }} {{ $form->first_surname }}
                    {{ $form->second_surname }}</td>
                <td class="px-6 py-4 text-left">{{ $form->phone }}</td>
                <td class="px-6 py-4 text-center"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>