@extends('layouts.master')
@section('titulo', 'reporte_mensual')
@section('contenido')
    <header id="encabezado">
        <h2 class="tittle">INFORME REAL DE INGRESOS</h2>
        <h2 class="tittle">CENTRO DE BACHILLERATO TECNOLOGICO AGROPECUARIO No.284</h2>
    </header>
    <div class="master_box">
        <section>
            <table>
                <tr>
                    <td>CLAVE DEL</td>
                    <td>EJERCICIO FISCAL</td>
                    <td>PERIODO DE INFORME</td>
                    <td>FECHA DE</td>
                </tr>
                <tr>
                    <td>agregar clave</td>
                    <td>agregar año</td>
                    <td>agregar mes</td>
                    <td>agregar fecha</td>
                </tr>
            </table>
        </section>

        <section>
            <table>
                <tr>
                    <td>CLAVE</td>
                    <td>DESCRIPCION</td>
                    <td>IMPORTES</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Grupo/subgrupo</td>
                    <td></td>
                    <td>SUBGRUPO</td>
                    <td>GRUPO</td>
                </tr>
                <tr>
                    <td>#agregarGrupoId</td>
                    <td>#</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>#agregarSubGrupoId</td>
                    <td>#</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </section>

        <section>
            <table>
                <thead>
                    <p class="tittle">MOVIMIENTOS DE LA CUENTA DE CAJA</p>
                </thead>
                <tr>
                    <td>SALDO DEL MES ANTERIOR</td>
                    <td></td>
                    <td>(agregar saldo)</td>

                </tr>
                <tr>
                    <td>INGRESOS</td>
                    <td></td>
                    <td>(agregar ingresos)</td>

                </tr>
                <tr>
                    <td>TOTAL DISPONIBLE</td>
                    <td></td>
                    <td>(agregar total)</td>
                    </tr>
            </table>
        </section>

        <section>
            <table>
                <thead>
                    <p class="tittle">FOLIOS DE RECIBOS OFICIALES DE COBROS CANCELADOS DEL MES:</p>
                </thead>
                <tr>
                    <td>FOLIOS ASIGNADOS EN LA ULTIMA DOTACION</td>
                    <td></td>
                    <td></td>
                    <td>TOTAL DE FOLIOS UTILIZADOS EN EL MES</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>INICIAL</td>
                    <td></td>
                    <td>FINAL</td>
                    <td>CANTIDAD</td>
                    <td>DEL</td>
                    <td>AL</td>
                </tr>
                <tr>
                    <td>TOTAL DISPONIBLE</td>
                    <td></td>
                    <td>(agregar total)</td>
                    <td></td>
                    <td>(fecha)</td>
                    <td>(fecha)</td>
                </tr>
            </table>
        </section>
    </div>
@endsection
