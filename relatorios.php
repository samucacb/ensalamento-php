<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - Sistema de Ensalamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-building"></i> Sistema de Ensalamento
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salas.php">
                            <i class="bi bi-door-open"></i> Salas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="turmas.php">
                            <i class="bi bi-people"></i> Turmas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ensalamento.php">
                            <i class="bi bi-calendar-check"></i> Ensalamento
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="relatorios.php">
                            <i class="bi bi-graph-up"></i> Relatórios
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0">Relatórios e Analytics</h1>
                <p class="text-muted">Análises detalhadas do sistema de ensalamento</p>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <select class="form-select" id="periodo-select" onchange="atualizarRelatorios()">
                        <option value="2025.1" selected>2025.1</option>
                        <option value="2025.2">2025.2</option>
                        <option value="2024.2">2024.2</option>
                    </select>
                    <button type="button" class="btn btn-outline-primary" onclick="exportarRelatorio()">
                        <i class="bi bi-download"></i> Exportar
                    </button>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Tipo de Relatório</label>
                        <select class="form-select" id="tipo-relatorio" onchange="atualizarRelatorios()">
                            <option value="geral" selected>Visão Geral</option>
                            <option value="ocupacao">Ocupação de Salas</option>
                            <option value="eficiencia">Eficiência</option>
                            <option value="conflitos">Conflitos</option>
                            <option value="ponto_otimo">Ponto Ótimo de Dobra</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Curso</label>
                        <select class="form-select" id="curso-filtro" onchange="atualizarRelatorios()">
                            <option value="">Todos os Cursos</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tipo de Sala</label>
                        <select class="form-select" id="tipo-sala-filtro" onchange="atualizarRelatorios()">
                            <option value="">Todos os Tipos</option>
                            <option value="comum">Comum</option>
                            <option value="laboratorio">Laboratório</option>
                            <option value="auditorio">Auditório</option>
                            <option value="pratica">Prática</option>
                            <option value="informatica">Informática</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="status-filtro" onchange="atualizarRelatorios()">
                            <option value="">Todos os Status</option>
                            <option value="alocado">Alocado</option>
                            <option value="conflito">Conflito</option>
                            <option value="pendente">Pendente</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

<!-- ================================================================= -->
<!-- VERSÃO FINAL E CORRIGIDA COM RÓTULOS CLAROS -->
<!-- ================================================================= -->
<div class="row mb-4" id="metricas-principais">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="text-primary mb-0" id="metric-total-ensalamentos">-</h2>
                <p class="text-muted mb-0">Total de Ensalamentos</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="text-success mb-0" id="metric-taxa-sucesso">-</h2>
                <!-- Rótulo Corrigido -->
                <p class="text-muted mb-0" title="Percentual de turmas que foram alocadas com sucesso.">
                    Taxa de Alocação
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="text-info mb-0" id="metric-eficiencia-media">-</h2>
                <!-- Rótulo Corrigido -->
                <p class="text-muted mb-0" title="Média de ocupação da capacidade das salas pelas turmas alocadas.">
                    Eficiência de Ocupação
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="text-warning mb-0" id="metric-salas-utilizadas">-</h2>
                <p class="text-muted mb-0">Salas Utilizadas</p>
            </div>
        </div>
    </div>
</div>


        <!-- Gráficos -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-pie-chart"></i> Distribuição por Status
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="chart-status-distribuicao" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-bar-chart"></i> Ocupação por Horário
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="chart-ocupacao-horario" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-graph-up"></i> Eficiência por Sala
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="chart-eficiencia-sala" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-speedometer2"></i> Indicadores de Performance
                        </h5>
                    </div>
                    <div class="card-body">
                        <div id="indicadores-performance">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Taxa de Alocação</span>
                                    <span id="taxa-alocacao">-</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" id="progress-alocacao" style="width: 0%"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Utilização de Salas</span>
                                    <span id="utilizacao-salas">-</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" id="progress-utilizacao" style="width: 0%"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Eficiência Geral</span>
                                    <span id="eficiencia-geral">-</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" id="progress-eficiencia" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- Adicione este bloco em relatorios.php -->

<div class="row mb-4">
    <div class="col-12">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-exclamation-octagon-fill"></i> Análise de Conflitos de Sala
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover" id="tabela-conflitos">
                        <thead>
                            <tr>
                                <th>Sala do Conflito</th>
                                <th>Turma 1</th>
                                <th>Turma 2</th>
                                <th>Dias</th>
                                <th>Horário</th>
                            </tr>
                        </thead>
                        <tbody id="corpo-tabela-conflitos">
                            <!-- Os dados do conflito serão preenchidos aqui -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-muted small">
                Este relatório mostra turmas que foram forçadas na mesma sala, no mesmo dia e horário, causando um conflito direto.
            </div>
        </div>
    </div>
</div>



        <!-- Tabelas Detalhadas -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-table"></i> Dados Detalhados
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tabela-detalhada">
                                <thead>
                                    <tr id="cabecalho-tabela">
                                        <!-- Cabeçalho será preenchido dinamicamente -->
                                    </tr>
                                </thead>
                                <tbody id="corpo-tabela">
                                    <!-- Dados serão preenchidos dinamicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Exportação -->
    <div class="modal fade" id="modalExportacao" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Exportar Relatório</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formExportacao">
                        <div class="mb-3">
                            <label for="formato-exportacao" class="form-label">Formato</label>
                            <select class="form-select" id="formato-exportacao" name="formato">
                                <option value="csv">CSV (Excel)</option>
                                <option value="json">JSON</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="incluir-graficos" class="form-label">Incluir</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="incluir-graficos" checked>
                                <label class="form-check-label" for="incluir-graficos">
                                    Gráficos e visualizações
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="incluir-detalhes" checked>
                                <label class="form-check-label" for="incluir-detalhes">
                                    Dados detalhados
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="confirmarExportacao()">
                        <i class="bi bi-download"></i> Exportar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="assets/js/relatorios.js"></script> -->
    
    <script>
        // Variáveis globais
        let chartStatusDistribuicao, chartOcupacaoHorario, chartEficienciaSala;
        
        // Inicializar página
        document.addEventListener('DOMContentLoaded', function() {
            carregarFiltros();
            atualizarRelatorios();
        });

        function carregarFiltros() {
            // Carregar cursos
            fetch('api/relatorios.php?action=cursos')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const select = document.getElementById('curso-filtro');
                        data.data.forEach(curso => {
                            const option = document.createElement('option');
                            option.value = curso;
                            option.textContent = curso;
                            select.appendChild(option);
                        });
                    }
                });
        }

        function atualizarRelatorios() {
            const periodo = document.getElementById('periodo-select').value;
            const tipo = document.getElementById('tipo-relatorio').value;
            const curso = document.getElementById('curso-filtro').value;
            const tipoSala = document.getElementById('tipo-sala-filtro').value;
            const status = document.getElementById('status-filtro').value;
            
            const filtros = {
                periodo: periodo,
                tipo: tipo,
                curso: curso,
                tipo_sala: tipoSala,
                status: status
            };
            
            carregarMetricas(filtros);
            carregarGraficos(filtros);
            carregarTabelaDetalhada(filtros);
            carregarAnaliseDeConflitos(filtros);
        }

        function carregarMetricas(filtros) {
            const params = new URLSearchParams(filtros);
            
            fetch(`api/relatorios.php?action=metricas&${params}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const metricas = data.data;
                        
                        document.getElementById('metric-total-ensalamentos').textContent = metricas.total_ensalamentos || 0;
                        document.getElementById('metric-taxa-sucesso').textContent = (metricas.taxa_sucesso || 0).toFixed(1) + '%';
                        document.getElementById('metric-eficiencia-media').textContent = (metricas.eficiencia_media || 0).toFixed(1) + '%';
                        document.getElementById('metric-salas-utilizadas').textContent = metricas.salas_utilizadas || 0;
                        
                        // Atualizar indicadores de performance
                        atualizarIndicadores(metricas);
                    }
                })
                .catch(error => console.error('Erro ao carregar métricas:', error));
        }

        function atualizarIndicadores(metricas) {
            const taxaAlocacao = metricas.taxa_sucesso || 0;
            const utilizacaoSalas = metricas.utilizacao_salas || 0;
            const eficienciaGeral = metricas.eficiencia_media || 0;
            
            document.getElementById('taxa-alocacao').textContent = taxaAlocacao.toFixed(1) + '%';
            document.getElementById('progress-alocacao').style.width = taxaAlocacao + '%';
            
            document.getElementById('utilizacao-salas').textContent = utilizacaoSalas.toFixed(1) + '%';
            document.getElementById('progress-utilizacao').style.width = utilizacaoSalas + '%';
            
            document.getElementById('eficiencia-geral').textContent = eficienciaGeral.toFixed(1) + '%';
            document.getElementById('progress-eficiencia').style.width = eficienciaGeral + '%';
        }

        function carregarGraficos(filtros) {
            const params = new URLSearchParams(filtros);
            
            // Gráfico de distribuição por status
            fetch(`api/relatorios.php?action=grafico_status&${params}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        criarGraficoStatusDistribuicao(data.data);
                    }
                });
            
            // Gráfico de ocupação por horário
            fetch(`api/relatorios.php?action=grafico_ocupacao_horario&${params}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        criarGraficoOcupacaoHorario(data.data);
                    }
                });
            
            // Gráfico de eficiência por sala
            fetch(`api/relatorios.php?action=grafico_eficiencia_sala&${params}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        criarGraficoEficienciaSala(data.data);
                    }
                });
        }

        function carregarTabelaDetalhada(filtros) {
            const params = new URLSearchParams(filtros);
            
            fetch(`api/relatorios.php?action=tabela_detalhada&${params}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        preencherTabelaDetalhada(data.data);
                    }
                })
                .catch(error => console.error('Erro ao carregar tabela:', error));
        }

        // No <script> do seu relatorios.php

        function criarGraficoStatusDistribuicao(dados) {
            const canvasElement = document.getElementById('chart-status-distribuicao');
            if (!canvasElement) return;

            if (chartStatusDistribuicao) {
                chartStatusDistribuicao.destroy();
            }
            
            // Esta versão entende tanto {alocadas: X, ...} quanto {labels: [...], data: [...]}
            const labels = dados.labels || ['Alocadas', 'Conflitos', 'Pendentes'];
            const dataPoints = dados.data || [dados.alocadas || 0, dados.conflitos || 0, dados.pendentes || 0];

            chartStatusDistribuicao = new Chart(canvasElement, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: dataPoints,
                        backgroundColor: ['#28a745', '#dc3545', '#ffc107'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: { /* ... opções ... */ }
            });
        }

        function criarGraficoOcupacaoHorario(dados) {
            const canvasElement = document.getElementById('chart-ocupacao-horario');
            if (!canvasElement) return;

            if (chartOcupacaoHorario) {
                chartOcupacaoHorario.destroy();
            }
            
            // Aceita tanto 'values' quanto 'data' para os pontos do gráfico
            const dataPoints = dados.values || dados.data || [];

            chartOcupacaoHorario = new Chart(canvasElement, {
                type: 'bar',
                data: {
                    labels: dados.labels || [],
                    datasets: [{
                        label: 'Aulas Alocadas',
                        data: dataPoints,
                        backgroundColor: '#007bff'
                    }]
                },
                options: { /* ... opções ... */ }
            });
        }

// No <script> do seu relatorios.php

function criarGraficoEficienciaSala(dados) {
    const canvasElement = document.getElementById('chart-eficiencia-sala');
    if (!canvasElement) return;

    if (chartEficienciaSala) {
        chartEficienciaSala.destroy();
    }
    
    // ==========================================================
    // CORREÇÃO AQUI: Verificamos se 'dados' não é nulo antes de usá-lo.
    // E usamos um fallback (|| []) para garantir que sempre tenhamos um array.
    // ==========================================================
    const labels = (dados && dados.labels) ? dados.labels : [];
    const dataPoints = (dados && dados.data) ? dados.data : [];

    chartEficienciaSala = new Chart(canvasElement, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Eficiência (%)',
                data: dataPoints,
                backgroundColor: dados ? (dados.colors || '#17a2b8') : '#17a2b8'
            }]
        },
        options: {
            indexAxis: 'y', // Para barras horizontais
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) { return value + '%'; }
                    }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
}


        function preencherTabelaDetalhada(dados) {
            const cabecalho = document.getElementById('cabecalho-tabela');
            const corpo = document.getElementById('corpo-tabela');
            
            // Limpar tabela
            cabecalho.innerHTML = '';
            corpo.innerHTML = '';
            
            if (!dados || !dados.colunas || !dados.linhas) {
                corpo.innerHTML = '<tr><td colspan="100%" class="text-center text-muted">Nenhum dado disponível</td></tr>';
                return;
            }
            
            // Criar cabeçalho
            dados.colunas.forEach(coluna => {
                const th = document.createElement('th');
                th.textContent = coluna.titulo;
                cabecalho.appendChild(th);
            });
            
            // Criar linhas
            dados.linhas.forEach(linha => {
                const tr = document.createElement('tr');
                
                dados.colunas.forEach(coluna => {
                    const td = document.createElement('td');
                    let valor = linha[coluna.campo] || '-';
                    
                    // Formatação especial para alguns tipos
                    if (coluna.tipo === 'porcentagem') {
                        valor = parseFloat(valor).toFixed(1) + '%';
                    } else if (coluna.tipo === 'status') {
                        td.innerHTML = `<span class="badge badge-status-${valor}">${valor}</span>`;
                        tr.appendChild(td);
                        return;
                    }
                    
                    td.textContent = valor;
                    tr.appendChild(td);
                });
                
                corpo.appendChild(tr);
            });
        }

        function exportarRelatorio() {
            const modal = new bootstrap.Modal(document.getElementById('modalExportacao'));
            modal.show();
        }

 // Em relatorios.php, no <script>

// +++ VERSÃO FINAL E CORRIGIDA +++
function confirmarExportacao() {
    const formato = document.getElementById('formato-exportacao').value;
    // Você pode adicionar lógica para outros formatos aqui se quiser
    if (formato !== 'csv') {
        alert('A exportação para ' + formato.toUpperCase() + ' ainda não foi implementada.');
        return;
    }

    const periodo = document.getElementById('periodo-select').value;
    const tipo = document.getElementById('tipo-relatorio').value;
    
    const params = new URLSearchParams({
        action: 'exportar',
        formato: formato,
        periodo: periodo,
        tipo: tipo
    });

    // 1. Chamar a API usando fetch
    fetch(`api/relatorios.php?${params}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // 2. Decodificar o conteúdo Base64 para dados binários
                const byteCharacters = atob(data.data.content);
                const byteNumbers = new Array(byteCharacters.length);
                for (let i = 0; i < byteCharacters.length; i++) {
                    byteNumbers[i] = byteCharacters.charCodeAt(i);
                }
                const byteArray = new Uint8Array(byteNumbers);
                const blob = new Blob([byteArray], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

                // 3. Criar um link de download temporário
                const link = document.createElement('a');
                const url = URL.createObjectURL(blob);
                link.setAttribute('href', url);
                link.setAttribute('download', data.data.filename);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);

                // 4. Clicar no link para iniciar o download
                link.click();

                // 5. Limpar o link temporário
                document.body.removeChild(link);

            } else {
                alert('Erro ao exportar relatório: ' + (data.message || 'Erro desconhecido'));
            }
        })
        .catch(error => {
            console.error('Erro na comunicação durante a exportação:', error);
            alert('Erro na comunicação com o servidor.');
        });

    // Fechar o modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalExportacao'));
    if (modal) {
        modal.hide();
    }
}


function carregarAnaliseDeConflitos(filtros) {
    const params = new URLSearchParams(filtros);
    
    fetch(`api/relatorios.php?action=analise_conflitos&${params}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                exibirAnaliseDeConflitos(data.data);
            }
        })
        .catch(error => console.error('Erro ao carregar análise de conflitos:', error));
}

function exibirAnaliseDeConflitos(conflitos) {
    const tbody = document.getElementById('corpo-tabela-conflitos');
    if (!tbody) return;

    tbody.innerHTML = ''; // Limpa a tabela

    if (!conflitos || conflitos.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center text-muted">
                    <i class="bi bi-check-circle-fill text-success"></i> Nenhum conflito de sala fixa detectado.
                </td>
            </tr>
        `;
        return;
    }

    let html = '';
    conflitos.forEach(item => {
        html += `
            <tr>
                <td><strong>${item.sala_codigo}</strong>  
<small>${item.sala_nome}</small></td>
                <td><strong>${item.turma1_codigo}</strong>  
<small>${item.turma1_nome}</small></td>
                <td><strong>${item.turma2_codigo}</strong>  
<small>${item.turma2_nome}</small></td>
                <td>${item.dias}</td>
                <td>${item.horario}</td>
            </tr>
        `;
    });

    tbody.innerHTML = html;
}
    </script>
</body>
</html>

