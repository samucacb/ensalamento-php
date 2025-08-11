<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ensalamento - Sistema de Ensalamento</title>
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
                        <a class="nav-link active" href="ensalamento.php">
                            <i class="bi bi-calendar-check"></i> Ensalamento
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="relatorios.php">
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
                <h1 class="h3 mb-0">Execução de Ensalamento</h1>
                <p class="text-muted">Configure e execute o algoritmo de ensalamento</p>
            </div>
        </div>

        <!-- Status do Sistema -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="text-primary mb-0" id="total-salas-disponiveis">-</h4>
                        <small class="text-muted">Salas Disponíveis</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="text-info mb-0" id="total-turmas-pendentes">-</h4>
                        <small class="text-muted">Turmas Pendentes</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="text-success mb-0" id="ultimo-ensalamento">-</h4>
                        <small class="text-muted">Último Ensalamento</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="text-warning mb-0" id="eficiencia-anterior">-</h4>
                        <small class="text-muted">Eficiência Anterior</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Configuração do Ensalamento -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-gear"></i> Configuração do Ensalamento
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="formEnsalamento">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="periodo" class="form-label">Período Letivo *</label>
                                        <select class="form-select" id="periodo" name="periodo" required>
                                            <option value="">Selecione o período</option>
                                            <option value="2025.1" selected>2025.1</option>
                                            <option value="2025.2">2025.2</option>
                                            <option value="2024.2">2024.2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="algoritmo" class="form-label">Algoritmo *</label>
                                        <select class="form-select" id="algoritmo" name="algoritmo" required onchange="mostrarDescricaoAlgoritmo()">
                                            <option value="">Selecione o algoritmo</option>
                                            <option value="guloso">Guloso (Rápido)</option>
                                            <option value="otimizado" selected>Otimizado (Melhor resultado)</option>
                                            <option value="hibrido">Híbrido (Equilibrado)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="alert alert-info" id="descricao-algoritmo">
                                    <strong>Algoritmo Otimizado:</strong> Analisa todas as possibilidades para encontrar a melhor alocação. Recomendado para obter os melhores resultados.
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="max-tentativas" class="form-label">Máximo de Tentativas</label>
                                        <input type="number" class="form-control" id="max-tentativas" name="max_tentativas" value="3" min="1" max="10">
                                        <div class="form-text">Número máximo de tentativas por turma</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="timeout" class="form-label">Timeout (segundos)</label>
                                        <input type="number" class="form-control" id="timeout" name="timeout" value="300" min="60" max="1800">
                                        <div class="form-text">Tempo limite para execução</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="prioridade" class="form-label">Prioridade</label>
                                        <select class="form-select" id="prioridade" name="prioridade">
                                            <option value="capacidade">Capacidade da Sala</option>
                                            <option value="tipo" selected>Tipo de Aula</option>
                                            <option value="professor">Professor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="permitir-superlotacao" name="permitir_superlotacao">
                                        <label class="form-check-label" for="permitir-superlotacao">
                                            Permitir superlotação (até 10%)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="calcular-dobra" name="calcular_dobra" checked>
                                        <label class="form-check-label" for="calcular-dobra">
                                            Calcular ponto ótimo de dobra
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-primary btn-lg" onclick="executarEnsalamento()">
                                    <i class="bi bi-play-circle"></i> Executar Ensalamento
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <!-- Histórico de Execuções -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">
                            <i class="bi bi-clock-history"></i> Histórico de Execuções
                        </h6>
                    </div>
                    <div class="card-body">
                        <div id="historico-execucoes">
                            <div class="text-center text-muted">
                                <i class="bi bi-clock-history fs-1"></i>
                                <p class="mt-2">Nenhuma execução recente</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Dicas -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="card-title mb-0">
                            <i class="bi bi-lightbulb"></i> Dicas
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled small">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Use o algoritmo <strong>Otimizado</strong> para melhores resultados
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Verifique se todas as salas estão ativas
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Confirme os dados das turmas antes de executar
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                O cálculo de dobra ajuda na otimização
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resultados do Ensalamento -->
        <div class="row mt-4" id="resultados-container" style="display: none;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-check-circle text-success"></i> Resultados do Ensalamento
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4 class="text-success mb-0" id="resultado-alocadas">-</h4>
                                    <small class="text-muted">Turmas Alocadas</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4 class="text-danger mb-0" id="resultado-conflitos">-</h4>
                                    <small class="text-muted">Conflitos</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4 class="text-primary mb-0" id="resultado-eficiencia">-</h4>
                                    <small class="text-muted">Eficiência</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4 class="text-info mb-0" id="resultado-tempo">-</h4>
                                    <small class="text-muted">Tempo (ms)</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Recomendações de Dobra:</h6>
                                <div id="recomendacoes-dobra">
                                    <p class="text-muted">Nenhuma recomendação disponível</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Conflitos Detectados:</h6>
                                <div id="conflitos-detectados">
                                    <p class="text-muted">Nenhum conflito detectado</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <button type="button" class="btn btn-outline-primary" onclick="verDetalhesResultado()">
                                <i class="bi bi-eye"></i> Ver Detalhes Completos
                            </button>
                            <button type="button" class="btn btn-outline-success" onclick="salvarResultado()">
                                <i class="bi bi-save"></i> Salvar Resultado
                            </button>
                            <button type="button" class="btn btn-outline-info" onclick="exportarResultado()">
                                <i class="bi bi-download"></i> Exportar
                            </button>
                        </div>
                    </div>
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
                        <span class="visually-hidden">Processando...</span>
                    </div>
                    <p id="progresso-texto">Iniciando processamento...</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%" id="progresso-barra"></div>
                    </div>
                    <small class="text-muted mt-2 d-block" id="progresso-detalhes">Aguarde...</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Variáveis globais
        let ultimoResultado = null;
        let modalProgresso = null;
        
        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            carregarStatusSistema();
            carregarHistorico();
            modalProgresso = new bootstrap.Modal(document.getElementById('modalProgresso'));
        });

// Em ensalamento.php, dentro do <script>

function carregarStatusSistema() {
    const periodoEl = document.getElementById('periodo');
    if (!periodoEl) {
        console.error("Elemento do seletor de período com ID 'periodo' não encontrado.");
        return;
    }
    const periodo = periodoEl.value;
    
    fetch(`api/ensalamento.php?action=status&periodo=${periodo}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                exibirStatus(data.data);
            } else {
                console.error('Erro ao carregar status:', data.message);
            }
        })
        .catch(error => {
            console.error('Erro na comunicação ao carregar status:', error);
        });
}



/*        function atualizarStatusSistema(status) {
            document.getElementById('total-salas-disponiveis').textContent = status.salas_disponiveis || 0;
            document.getElementById('total-turmas-pendentes').textContent = status.turmas_pendentes || 0;
            document.getElementById('ultimo-ensalamento').textContent = status.ultimo_ensalamento || 'Nunca';
            document.getElementById('eficiencia-anterior').textContent = status.eficiencia_anterior ? status.eficiencia_anterior + '%' : '-';
        } */

// Em ensalamento.php, dentro do <script>

function carregarHistorico() {
    // CORREÇÃO: Usar um valor padrão no carregamento inicial.
    const periodoPadrao = '2025.1';

    fetch(`api/relatorios.php?action=historico&periodo=${periodoPadrao}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                exibirHistorico(data.data);
            } else {
                console.error('Erro ao carregar histórico:', data.message || 'Resposta sem sucesso da API.');
            }
        })
        .catch(error => {
            console.error('Erro na comunicação ao carregar histórico:', error);
        });
}

// GARANTA QUE ESTA É A ÚNICA VERSÃO DA FUNÇÃO NO SEU SCRIPT

function exibirHistorico(historico) {
    // Procura pelo ID correto, que é a div 'historico-execucoes'.
    const container = document.getElementById('historico-execucoes');

    if (!container) {
        // Esta mensagem só deve aparecer se o HTML não tiver a div com o ID correto.
        console.error("Elemento container do histórico ('historico-execucoes') não encontrado.");
        return;
    }

    // Limpa o container antes de adicionar o novo conteúdo.
    container.innerHTML = '';

    if (!historico || historico.length === 0) {
        // Se não houver histórico, exibe a mensagem padrão.
        container.innerHTML = `
            <div class="text-center text-muted py-3">
                <i class="bi bi-clock-history fs-2"></i>
                <p class="mt-2 mb-0">Nenhuma execução recente</p>
            </div>
        `;
        return;
    }

    // Se houver histórico, cria uma lista para exibi-lo.
    let html = '<ul class="list-group list-group-flush">';
    
    historico.forEach(item => {
        const dataFormatada = new Date(item.data_execucao + 'T00:00:00').toLocaleDateString('pt-BR');
        const eficienciaFormatada = parseFloat(item.eficiencia_media || 0).toFixed(1);

        html += `
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                <div>
                    <h6 class="mb-0">${dataFormatada}</h6>
                    <small class="text-muted">
                        ${item.turmas_processadas || 0} turmas via <strong>${item.algoritmo_usado || 'N/A'}</strong>
                    </small>
                </div>
                <span class="badge bg-primary rounded-pill">${eficienciaFormatada}%</span>
            </li>
        `;
    });

    html += '</ul>';
    container.innerHTML = html;
}




        function mostrarDescricaoAlgoritmo() {
            const algoritmo = document.getElementById('algoritmo').value;
            const descricaoDiv = document.getElementById('descricao-algoritmo');
            
            const descricoes = {
                'guloso': '<strong>Algoritmo Guloso:</strong> Execução rápida com boa eficiência. Ideal para cenários simples com poucas restrições.',
                'otimizado': '<strong>Algoritmo Otimizado:</strong> Analisa todas as possibilidades para encontrar a melhor alocação. Recomendado para obter os melhores resultados.',
                'hibrido': '<strong>Algoritmo Híbrido:</strong> Combina velocidade e qualidade, oferecendo um bom equilíbrio entre tempo de execução e resultado.'
            };
            
            descricaoDiv.innerHTML = descricoes[algoritmo] || '';
            descricaoDiv.className = algoritmo ? 'alert alert-info' : 'alert alert-info d-none';
        }

function executarEnsalamento() {
    const form = document.getElementById('formEnsalamento');
    const formData = new FormData(form);
    
    // Validar formulário
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    // Mostrar modal de progresso
    modalProgresso.show();
    
    // Simular progresso
    simularProgresso();
    
    // Executar ensalamento
    fetch('api/ensalamento.php?action=executar', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Aguardar a simulação de progresso terminar
        setTimeout(() => {
            // CORREÇÃO AQUI: Remove o foco do elemento ativo antes de fechar o modal.
            if (document.activeElement) document.activeElement.blur();
            
            modalProgresso.hide();
            
            if (data.success) {
                ultimoResultado = data.data;
                exibirResultados(data.data);
                carregarStatusSistema();
                carregarHistorico();
            } else {
                mostrarErro('Erro ao executar ensalamento: ' + data.message);
            }
        }, 2000); // Aguardar 2 segundos após a conclusão
    })
    .catch(error => {
        setTimeout(() => {
            // CORREÇÃO AQUI: Também remove o foco em caso de erro de comunicação.
            if (document.activeElement) document.activeElement.blur();

            modalProgresso.hide();
            mostrarErro('Erro na comunicação: ' + error.message);
        }, 2000);
    });
}

        function simularProgresso() {
            const progressBar = document.getElementById('progresso-barra');
            const progressText = document.getElementById('progresso-texto');
            const progressDetails = document.getElementById('progresso-detalhes');
            
            const etapas = [
                { texto: 'Carregando dados...', detalhes: 'Lendo salas e turmas do banco de dados', progresso: 10 },
                { texto: 'Validando dados...', detalhes: 'Verificando consistência dos dados', progresso: 25 },
                { texto: 'Executando algoritmo...', detalhes: 'Processando alocações', progresso: 50 },
                { texto: 'Calculando otimizações...', detalhes: 'Analisando pontos de melhoria', progresso: 75 },
                { texto: 'Finalizando...', detalhes: 'Salvando resultados', progresso: 90 }
            ];
            
            let etapaAtual = 0;
            
            const interval = setInterval(() => {
                if (etapaAtual < etapas.length) {
                    const etapa = etapas[etapaAtual];
                    progressText.textContent = etapa.texto;
                    progressDetails.textContent = etapa.detalhes;
                    progressBar.style.width = etapa.progresso + '%';
                    etapaAtual++;
                } else {
                    clearInterval(interval);
                    progressBar.style.width = '100%';
                    progressText.textContent = 'Concluído!';
                    progressDetails.textContent = 'Processamento finalizado com sucesso';
                }
            }, 1000);
        }

// Em seu arquivo de frontend (ensalamento.php ou .js)

function exibirResultados(resultado) {
    // --- VERSÃO CORRIGIDA ---
    // Corrigido para usar os nomes de chave que a API realmente envia.
    document.getElementById('resultado-alocadas').textContent = resultado.turmas_alocadas || 0;
    document.getElementById('resultado-conflitos').textContent = resultado.conflitos || 0; // Corrigido de 'turmas_conflito'
    document.getElementById('resultado-eficiencia').textContent = (resultado.eficiencia || 0).toFixed(1) + '%'; // Corrigido de 'eficiencia_media'
    document.getElementById('resultado-tempo').textContent = resultado.tempo_execucao || 0; // Corrigido de 'tempo_processamento'
    
    // O resto da sua função já está correto e não precisa de alterações.
    
    // Recomendações de dobra
    const recomendacoesDiv = document.getElementById('recomendacoes-dobra');
    if (resultado.recomendacoes_dobra && resultado.recomendacoes_dobra.length > 0) {
        let html = '<ul class="list-unstyled">';
        resultado.recomendacoes_dobra.slice(0, 3).forEach(rec => {
            html += `<li><i class="bi bi-arrow-right text-primary me-2"></i>${rec}</li>`;
        });
        html += '</ul>';
        recomendacoesDiv.innerHTML = html;
    } else {
        recomendacoesDiv.innerHTML = '<p class="text-muted">Nenhuma recomendação disponível</p>';
    }
    
    // Conflitos detectados
    const conflitosDiv = document.getElementById('conflitos-detectados');
    // A API envia 'conflitos' como um número, não uma lista de strings.
    // Vamos adaptar para mostrar a contagem.
    if (resultado.conflitos && resultado.conflitos > 0) {
        conflitosDiv.innerHTML = `<p class="text-warning">${resultado.conflitos} conflitos foram detectados. Verifique a página de relatórios para mais detalhes.</p>`;
    } else {
        conflitosDiv.innerHTML = '<p class="text-success">Nenhum conflito detectado</p>';
    }
    
    // Mostrar container de resultados
    document.getElementById('resultados-container').style.display = 'block';
    
    // Scroll para os resultados
    document.getElementById('resultados-container').scrollIntoView({ behavior: 'smooth' });
}


        function verDetalhesResultado() {
            if (!ultimoResultado) return;
            
            window.open('relatorios.php?tipo=ensalamento&id=' + ultimoResultado.id, '_blank');
        }

        function salvarResultado() {
            if (!ultimoResultado) return;
            
            fetch('api/ensalamento.php?action=salvar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ resultado_id: ultimoResultado.id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mostrarSucesso('Resultado salvo com sucesso!');
                } else {
                    mostrarErro('Erro ao salvar resultado: ' + data.message);
                }
            })
            .catch(error => {
                mostrarErro('Erro na comunicação: ' + error.message);
            });
        }

        function exportarResultado() {
            if (!ultimoResultado) return;
            
            window.open('api/ensalamento.php?action=exportar&id=' + ultimoResultado.id, '_blank');
        }

        function mostrarSucesso(mensagem) {
            console.log('Sucesso:', mensagem);
            alert(mensagem);
        }

        function mostrarErro(mensagem) {
            console.error('Erro:', mensagem);
            alert(mensagem);
        }

        // Em ensalamento.php, dentro do <script>

/* function exibirStatus(status) {
    // Encontra os elementos no HTML para exibir as informações de status.
    // ATENÇÃO: Verifique se os IDs abaixo correspondem aos IDs reais no seu HTML.
    const elementoTotalTurmas = document.getElementById('status-total-turmas');
    const elementoTurmasAlocadas = document.getElementById('status-turmas-alocadas');
    const elementoStatusGeral = document.getElementById('status-geral');

    // Atualiza o texto dos elementos com os dados recebidos da API.
    if (elementoTotalTurmas) {
        elementoTotalTurmas.textContent = status.total_turmas || 0;
    }
    if (elementoTurmasAlocadas) {
        elementoTurmasAlocadas.textContent = status.turmas_alocadas || 0;
    }
    if (elementoStatusGeral) {
        elementoStatusGeral.textContent = status.status_geral || 'Indisponível';
    }
} */

// Em ensalamento.php, dentro do <script>

function exibirStatus(status) {
    // ================================================================
    // ATENÇÃO: SUBSTITUA OS IDs ABAIXO PELOS SEUS IDs REAIS DO HTML
    // ================================================================
    const salasEl = document.getElementById('total-salas-disponiveis');
    if (salasEl) {
        salasEl.textContent = status.total_salas || 0;
    }

    const pendentesEl = document.getElementById('total-turmas-pendentes');
    if (pendentesEl) {
        pendentesEl.textContent = status.turmas_pendentes || 0;
    }

    const execucaoEl = document.getElementById('ultimo-ensalamento');
    if (execucaoEl) {
        if (status.ultima_execucao && status.ultima_execucao !== 'Nunca') {
            const data = new Date(status.ultima_execucao);
            execucaoEl.textContent = data.toLocaleString('pt-BR');
        } else {
            execucaoEl.textContent = 'Nunca';
        }
    }

    const eficienciaEl = document.getElementById('eficiencia-anterior');
    if (eficienciaEl) {
        eficienciaEl.textContent = (status.eficiencia_anterior || 0).toFixed(1) + '%';
    }
}

// Garante que a chamada inicial seja feita
document.addEventListener('DOMContentLoaded', function() {
    carregarStatusSistema();
    // ... suas outras chamadas ...
});

    </script>
</body>
</html>

