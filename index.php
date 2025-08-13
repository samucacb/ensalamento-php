<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ensalamento</title>
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
                        <a class="nav-link active" href="index.php">
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
                        <a class="nav-link" href="relatorios.php">
                            <i class="bi bi-graph-up"></i> Relatórios
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-gear"></i> Configurações
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="configuracoes.php">Parâmetros</a></li>
                            <li><a class="dropdown-item" href="backup.php">Backup</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="sobre.php">Sobre</a></li>
                        </ul>
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
                <h1 class="h3 mb-0">Dashboard</h1>
                <p class="text-muted">Visão geral do sistema de ensalamento</p>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-success" onclick="executarEnsalamento()">
                        <i class="bi bi-play-circle"></i> Executar Ensalamento
                    </button>
                    <button type="button" class="btn btn-outline-primary" onclick="atualizarDados()">
                        <i class="bi bi-arrow-clockwise"></i> Atualizar
                    </button>
                </div>
            </div>
        </div>

        <!-- Cards de Estatísticas -->
        <div class="row mb-4" id="cards-estatisticas">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Total de Salas</h6>
                                <h3 class="mb-0" id="total-salas">-</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-door-open fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Total de Turmas</h6>
                                <h3 class="mb-0" id="total-turmas">-</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-people fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Turmas Alocadas Por Dia</h6>
                                <h3 class="mb-0" id="turmas-alocadas">-</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-check-circle fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Eficiência Média</h6>
                                <h3 class="mb-0" id="eficiencia-media">-</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-speedometer2 fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos e Informações -->
        <div class="row">
            <!-- Status do Ensalamento -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-pie-chart"></i> Status do Ensalamento
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="chart-status" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Ocupação por Dia -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-bar-chart"></i> Ocupação por Dia da Semana
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="chart-ocupacao" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Últimas Atividades -->
        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-clock-history"></i> Últimas Atividades
                        </h5>
                    </div>
                    <div class="card-body">
                        <div id="ultimas-atividades">
                            <div class="text-center text-muted">
                                <i class="bi bi-hourglass-split"></i>
                                <p>Carregando atividades...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alertas e Problemas -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-exclamation-triangle"></i> Alertas
                        </h5>
                    </div>
                    <div class="card-body">
                        <div id="alertas-sistema">
                            <div class="text-center text-muted">
                                <i class="bi bi-shield-check"></i>
                                <p>Verificando sistema...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Execução de Ensalamento -->
    <div class="modal fade" id="modalEnsalamento" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Executar Ensalamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEnsalamento">
                        <div class="mb-3">
                            <label for="periodo" class="form-label">Período</label>
                            <select class="form-select" id="periodo" name="periodo" required>
                                <option value="2025.1" selected>2025.1</option>
                                <option value="2025.2">2025.2</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="algoritmo" class="form-label">Algoritmo</label>
                            <select class="form-select" id="algoritmo" name="algoritmo" required>
                                <option value="otimizado" selected>Otimizado (Recomendado)</option>
                                <option value="guloso">Guloso (Rápido)</option>
                                <option value="hibrido">Híbrido (Balanceado)</option>
                            </select>
                            <div class="form-text">
                                <strong>Otimizado:</strong> Melhor resultado, mais lento<br>
                                <strong>Guloso:</strong> Resultado bom, mais rápido<br>
                                <strong>Híbrido:</strong> Combina os dois algoritmos
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="limparAnterior" checked>
                            <label class="form-check-label" for="limparAnterior">
                                Limpar ensalamentos anteriores do período
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" onclick="confirmarEnsalamento()">
                        <i class="bi bi-play-circle"></i> Executar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Progresso -->
    <div class="modal fade" id="modalProgresso" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Executando Ensalamento</h5>
                </div>
                <div class="modal-body text-center">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                    <p id="progresso-texto">Iniciando processamento...</p>
                    <div id="progresso-detalhes" class="mt-3 text-muted small">
                        Aguarde enquanto o sistema processa as turmas...
                    </div>
                </div>
                <div class="modal-footer" style="display: none;" id="modal-footer-progresso">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/dashboard.js"></script>
    
</body>
</html>

