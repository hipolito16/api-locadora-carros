<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Repositories\LocacaoRepository;
use Illuminate\Http\Request;

class LocacaoController extends Controller
{
    public function __construct(Locacao $locacao)
    {
        $this->locacao = $locacao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locacaoRepository = new LocacaoRepository($this->locacao);

        if ($request->has('atributos_carro')) {
            $atributos_carros = 'carros:id,' . $request->atributos_carros;
            $locacaoRepository->selectAtributosRegistrosRelacionados($atributos_carros);
        } else {
            $locacaoRepository->selectAtributosRegistrosRelacionados('carros');
        }

        if ($request->has('atributos_cliente')) {
            $atributos_carro = 'clientes:id,' . $request->atributos_carros;
            $locacaoRepository->selectAtributosRegistrosRelacionados($atributos_carro);
        } else {
            $locacaoRepository->selectAtributosRegistrosRelacionados('clientes');
        }

        if ($request->has('filtro')) {
            $locacaoRepository->filtro($request->filtro);
        }

        if ($request->has('atributos')) {
            $locacaoRepository->selectAtributos($request->atributos);
        }

        return response()->json($locacaoRepository->getResultado(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->locacao->rules(), $this->locacao->feedback());

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

        $locacao = $this->locacao->create([
            'nome' => $request->nome,
            'imagem' => $imagem_urn
        ]);

        return response()->json($locacao, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Locacao $locacao
     * @return \Illuminate\Http\Response
     */
    public function show(Locacao $locacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Locacao $locacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Locacao $locacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Locacao $locacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Locacao $locacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Locacao $locacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Locacao $locacao)
    {
        //
    }
}
