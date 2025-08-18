<?php
    require_once __DIR__ . '/config/database.php';

$sql_periodos = "SELECT periodo FROM periodos ORDER BY periodo DESC"; // <-- ÚNICA LINHA ALTERADA
$stmt_periodos = $database->prepare($sql_periodos);
$stmt_periodos->execute();
$periodos_disponiveis = $stmt_periodos->fetchAll(PDO::FETCH_COLUMN);
$periodo_selecionado = $_GET['periodo'] ?? '';


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas - Sistema de Ensalamento</title>
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
                        <a class="nav-link active" href="turmas.php">
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
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0">Gestão de Turmas</h1>
                <p class="text-muted">Cadastro e gerenciamento de turmas</p>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary" onclick="importarTurmas()">
                        <i class="bi bi-upload"></i> Importar
                    </button>
                    <button type="button" class="btn btn-primary" onclick="novaTurma()">
                        <i class="bi bi-plus-circle"></i> Nova Turma
                    </button>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Buscar</label>
                        <input type="text" class="form-control" id="filtro-busca" placeholder="Código ou nome da turma" onkeyup="filtrarTurmas()">
                    </div>
<div class="col-md-2">
    <label for="filtro-periodo" class="form-label">Período</label>
    <select class="form-select" id="filtro-periodo" onchange="filtrarTurmas()">   
        <option value="" <?php echo (empty($periodo_selecionado)) ? 'selected' : ''; ?>>
            Todos
        </option> 
        <?php foreach ($periodos_disponiveis as $periodo_item): ?>
            <option value="<?php echo htmlspecialchars($periodo_item); ?>" <?php echo ($periodo_item === $periodo_selecionado) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($periodo_item); ?>
            </option>
        <?php endforeach; ?>

    </select>
</div>
                    <div class="col-md-2">
                        <label class="form-label">Curso</label>
                        <select class="form-select" id="filtro-curso" onchange="filtrarTurmas()">
                            <option value="">Todos</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Tipo de Aula</label>
                        <select class="form-select" id="filtro-tipo" onchange="filtrarTurmas()">
                            <option value="">Todos</option>
                            <option value="teorica">Teórica</option>
                            <option value="pratica">Prática</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary" onclick="limparFiltros()">
                                <i class="bi bi-x-circle"></i> Limpar
                            </button>
                            <button type="button" class="btn btn-outline-primary" onclick="exportarTurmas()">
                                <i class="bi bi-download"></i> Exportar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estatísticas -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <h3 class="mb-0" id="total-turmas">-</h3>
                        <p class="mb-0">Total de Turmas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h3 class="mb-0" id="turmas-alocadas">-</h3>
                        <p class="mb-0">Turmas Alocadas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <h3 class="mb-0" id="total-alunos">-</h3>
                        <p class="mb-0">Total de Alunos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <h3 class="mb-0" id="media-alunos">-</h3>
                        <p class="mb-0">Média por Turma</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela de Turmas -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-table"></i> Lista de Turmas
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tabela-turmas">
<!-- Em turmas.php -->
<thead>
    <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Professor</th>
        <th>Curso</th>
        <th>Tipo</th>
        <th>Alunos</th>
        <th>Período</th>
        <th>Turno</th> <!-- <-- CABEÇALHO ADICIONADO -->
        <th>Dias</th> <!-- <-- CABEÇALHO ADICIONADO -->
        <th>Horário</th> <!-- <-- CABEÇALHO ADICIONADO -->
        <th>Status</th>
        <th>Ações</th>
    </tr>
</thead>

                        <tbody id="tbody-turmas">
                            <tr>
                                <td colspan="9" class="text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Carregando...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nova/Editar Turma -->
    <div class="modal fade" id="modalTurma" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTurmaTitle">Nova Turma</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formTurma">
                        <input type="hidden" id="turma-id" name="id">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="turma-codigo" class="form-label">Código *</label>
                                    <input type="text" class="form-control" id="turma-codigo" name="codigo" required>
                                    <div class="form-text">Código único da turma (ex: MAT101, FIS201)</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="turma-nome" class="form-label">Nome *</label>
                                    <input type="text" class="form-control" id="turma-nome" name="nome" required>
                                    <div class="form-text">Nome da disciplina</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="turma-professor" class="form-label">Professor *</label>
                                    <input type="text" class="form-control" id="turma-professor" name="professor" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="turma-curso" class="form-label">Curso *</label>
                                    <input type="text" class="form-control" id="turma-curso" name="curso" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="turma-num-alunos" class="form-label">Número de Alunos *</label>
                                    <input type="number" class="form-control" id="turma-num-alunos" name="num_alunos" min="1" max="200" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="turma-tipo" class="form-label">Tipo de Aula *</label>
                                    <select class="form-select" id="turma-tipo" name="tipo_aula" required>
                                        <option value="">Selecione</option>
                                        <option value="teorica">Teórica</option>
                                        <option value="pratica">Prática</option>
                                    </select>
                                </div>
                            </div>
<!-- Substitua o seu campo de formulário estático por esta nova versão dinâmica -->

<div class="col-md-4"> <!-- ou col-md-6, mantenha o que já estava -->
    <div class="mb-3">
        <label for="turma-periodo" class="form-label">Período *</label>
        <select class="form-select" id="turma-periodo" name="periodo" required>
            
            <!-- Opção inicial para guiar o usuário -->
            <option value="">Selecione o período</option>
            
            <?php foreach ($periodos_disponiveis as $periodo_item): ?>
                <option value="<?php echo htmlspecialchars($periodo_item); ?>">
                    <?php echo htmlspecialchars($periodo_item); ?>
                </option>
            <?php endforeach; ?>

        </select>
    </div>
</div>

                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="turma-turno" class="form-label">Turno *</label>
                                    <select class="form-select" id="turma-turno" name="turno" required>
                                        <option value="">Selecione</option>
                                        <option value="matutino">Matutino</option>
                                        <option value="vespertino">Vespertino</option>
                                        <option value="noturno">Noturno</option>
                                        <option value="integral">Integral</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="turma-horario-inicio" class="form-label">Horário Início</label>
                                    <input type="time" class="form-control" id="turma-horario-inicio" name="horario_inicio">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="turma-horario-fim" class="form-label">Horário Fim</label>
                                    <input type="time" class="form-control" id="turma-horario-fim" name="horario_fim">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="turma-carga-horaria" class="form-label">Carga Horária</label>
                                    <input type="number" class="form-control" id="turma-carga-horaria" name="carga_horaria" min="0" max="200">
                                    <div class="form-text">Carga horária em horas</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label>Dias da semana:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="segunda" value="1" id="dia-segunda"> 
                                <label class="form-check-label" for="dia-segunda">Segunda</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="terca" value="1" id="dia-terca"> 
                                <label class="form-check-label" for="dia-terca">Terça</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="quarta" value="1" id="dia-quarta"> 
                                <label class="form-check-label" for="dia-quarta">Quarta</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="quinta" value="1" id="dia-quinta"> 
                                <label class="form-check-label" for="dia-quinta">Quinta</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="sexta" value="1" id="dia-sexta"> 
                                <label class="form-check-label" for="dia-sexta">Sexta</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="sabado" value="1" id="dia-sabado"> 
                                <label class="form-check-label" for="dia-sabado">Sábado</label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="turma-observacoes" class="form-label">Observações</label>
                            <textarea class="form-control" id="turma-observacoes" name="observacoes" rows="3"></textarea>
                            <div class="form-text">Informações adicionais sobre a turma</div>
                        </div>

                        <div class="mb-3">
                             <label for="turma-sala-fixa" class="form-label">
                              <i class="bi bi-pin-map-fill"></i> Forçar Sala (Opcional)
                             </label>
            
                             <select class="form-select" id="turma-sala-fixa" name="sala_fixa_id">
                             <option value="">Seleção Automática pelo Algoritmo</option>
                <!-- As opções de salas serão carregadas aqui pelo JavaScript -->
                             </select>
            
                         <div class="form-text">
                            Selecione para fixar esta turma em uma sala específica. Deixe em branco para o sistema decidir.
                        </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="salvarTurma()">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Importar Turmas -->
    <div class="modal fade" id="modalImportar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Importar Turmas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formImportar" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="arquivo-importar" class="form-label">Arquivo CSV</label>
                            <input type="file" class="form-control" id="arquivo-importar" name="arquivo" accept=".csv" required>
                            <div class="form-text">
                                Formato: codigo;nome;professor;curso;num_alunos;tipo_aula;periodo
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <h6>Formato do arquivo CSV:</h6>
                            <ul class="mb-0">
                                <li>Separador: ponto e vírgula (;)</li>
                                <li>Codificação: UTF-8</li>
                                <li>Primeira linha: cabeçalho</li>
                            </ul>
                        </div>
                        
                        <div class="mb-3">
                            <a href="api/turmas.php?action=modelo" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-download"></i> Baixar Modelo
                            </a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="executarImportacao()">Importar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Variáveis globais
        let turmas = [];
        let cursos = [];
        
        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            carregarTurmas();
            carregarCursos();
            carregarSalasParaSelect();
        });

        const modalTurmaElement = document.getElementById('modalTurma');
        modalTurmaElement.addEventListener('hide.bs.modal', function () {
            if (document.activeElement && modalTurmaElement.contains(document.activeElement)) {
                document.activeElement.blur();
            }
        });

        function carregarTurmas() {
            fetch('api/turmas.php?action=listar')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        turmas = data.data;
                        exibirTurmas(turmas);
                        atualizarEstatisticas(turmas);
                    } else {
                        mostrarErro('Erro ao carregar turmas: ' + data.message);
                    }
                })
                .catch(error => {
                    mostrarErro('Erro na comunicação: ' + error.message);
                });
        }

        function carregarCursos() {
            fetch('api/turmas.php?action=cursos')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        cursos = data.data;
                        preencherSelectCursos();
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar cursos:', error);
                });
        }

        // No seu <script> em turmas.php

function carregarSalasParaSelect() {
    // Chama a nova ação 'listar_simples' que criamos na API de salas
    fetch('api/salas.php?action=listar_simples')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const select = document.getElementById('turma-sala-fixa');
                
                // Proteção para caso o elemento não exista na página
                if (!select) {
                    console.error("Elemento 'turma-sala-fixa' não encontrado no formulário.");
                    return;
                }

                // Limpa opções antigas, exceto a primeira ("Seleção Automática")
                // Isso é útil se você precisar recarregar a lista no futuro
                while (select.options.length > 1) {
                    select.remove(1);
                }

                // Adiciona cada sala como uma nova opção no menu dropdown
                data.data.forEach(sala => {
                    const option = document.createElement('option');
                    option.value = sala.id; // O valor será o ID da sala
                    option.textContent = `${sala.codigo} - ${sala.nome}`; // O texto visível
                    select.appendChild(option);
                });
            } else {
                console.error('Falha ao carregar a lista de salas para o select.');
            }
        })
        .catch(error => {
            console.error('Erro de comunicação ao carregar salas:', error);
        });
}


        function preencherSelectCursos() {
            const select = document.getElementById('filtro-curso');
            select.innerHTML = '<option value="">Todos</option>';
            
            cursos.forEach(curso => {
                const option = document.createElement('option');
                option.value = curso;
                option.textContent = curso;
                select.appendChild(option);
            });
        }

        function exibirTurmas(listaTurmas) {
            const tbody = document.getElementById('tbody-turmas');
            
            if (listaTurmas.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            Nenhuma turma encontrada
                        </td>
                    </tr>
                `;
                return;
            }
            
           let html = '';
listaTurmas.forEach(turma => {
    const tipoBadge = turma.tipo_aula === 'teorica' ? 
        '<span class="badge bg-primary">Teórica</span>' : 
        '<span class="badge bg-success">Prática</span>';
    
    // --- LÓGICA CORRIGIDA PARA O STATUS ---
    const status = turma.status_ensalamento || 'Pendente'; 
    let statusBadge;

    if (status === 'alocado') {
        statusBadge = `<span class="badge bg-success">Alocado</span>`;
    } else if (status === 'conflito') {
        statusBadge = `<span class="badge bg-danger">Conflito</span>`;
    } else {
        statusBadge = `<span class="badge bg-warning">Pendente</span>`;
    }
    // --- FIM DA LÓGICA CORRIGIDA ---
    
    html += `
        <tr>
            <td><strong>${turma.codigo}</strong></td>
            <td>${turma.nome}</td>
            <td>${turma.professor}</td>
            <td>${turma.curso}</td>
            <td>${tipoBadge}</td>
            <td class="text-center">${turma.num_alunos}</td>
            <td>${turma.periodo}</td>
            <td>${turma.turno || '-'}</td>
            <td>${turma.dias_semana || '-'}</td>
            <td>${(turma.horario_inicio || '').substring(0, 5)} - ${(turma.horario_fim || '').substring(0, 5)}</td>
            <td>${statusBadge}</td>
            <td>
                <!-- SEU CÓDIGO ORIGINAL E CORRETO DOS BOTÕES -->
<td>
    <div class="btn-group btn-group-sm" role="group">
        <button type="button" class="btn btn-outline-primary" onclick="editarTurma(${turma.id})" title="Editar">
            <i class="bi bi-pencil"></i>
        </button>
        <button type="button" class="btn btn-outline-info" onclick="verDetalhes(${turma.id})" title="Detalhes">
            <i class="bi bi-eye"></i>
        </button>
        <button type="button" class="btn btn-outline-danger" onclick="excluirTurma(${turma.id})" title="Excluir">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</td>

            </td>
        </tr>
    `;
});

tbody.innerHTML = html;

        }

        function atualizarEstatisticas(listaTurmas) {
            const total = listaTurmas.length;
            const alocadas = listaTurmas.filter(t => t.sala_alocada).length;
            const totalAlunos = listaTurmas.reduce((sum, t) => sum + parseInt(t.num_alunos), 0);
            const mediaAlunos = total > 0 ? Math.round(totalAlunos / total) : 0;
            
            document.getElementById('total-turmas').textContent = total;
            document.getElementById('turmas-alocadas').textContent = alocadas;
            document.getElementById('total-alunos').textContent = totalAlunos;
            document.getElementById('media-alunos').textContent = mediaAlunos;
        }

        function filtrarTurmas() {
            const busca = document.getElementById('filtro-busca').value.toLowerCase();
            const periodo = document.getElementById('filtro-periodo').value;
            const curso = document.getElementById('filtro-curso').value;
            const tipo = document.getElementById('filtro-tipo').value;
            
            let turmasFiltradas = turmas.filter(turma => {
                // Filtro de busca
                if (busca && !turma.codigo.toLowerCase().includes(busca) && !turma.nome.toLowerCase().includes(busca)) {
                    return false;
                }
                
                // Filtro de período
                if (periodo && turma.periodo !== periodo) {
                    return false;
                }
                
                // Filtro de curso
                if (curso && turma.curso !== curso) {
                    return false;
                }
                
                // Filtro de tipo
                if (tipo && turma.tipo_aula !== tipo) {
                    return false;
                }
                
                return true;
            });
            
            exibirTurmas(turmasFiltradas);
            atualizarEstatisticas(turmasFiltradas);
        }

        function limparFiltros() {
            document.getElementById('filtro-busca').value = '';
            document.getElementById('filtro-periodo').value = '2025.1';
            document.getElementById('filtro-curso').value = '';
            document.getElementById('filtro-tipo').value = '';
            filtrarTurmas();
        }

        function novaTurma() {
            document.getElementById('modalTurmaTitle').textContent = 'Nova Turma';
            document.getElementById('formTurma').reset();
            document.getElementById('turma-id').value = '';
            document.getElementById('turma-periodo').value = '2025.1';
            
            const modal = new bootstrap.Modal(document.getElementById('modalTurma'));
            modal.show();
        }

        function editarTurma(id) {
            const turma = turmas.find(t => t.id == id);
            if (!turma) return;
            
            document.getElementById('modalTurmaTitle').textContent = 'Editar Turma';
            document.getElementById('turma-id').value = turma.id;
            document.getElementById('turma-codigo').value = turma.codigo;
            document.getElementById('turma-nome').value = turma.nome;
            document.getElementById('turma-professor').value = turma.professor;
            document.getElementById('turma-curso').value = turma.curso;
            document.getElementById('turma-num-alunos').value = turma.num_alunos;
            document.getElementById('turma-tipo').value = turma.tipo_aula;
            document.getElementById('turma-periodo').value = turma.periodo;
            document.getElementById('turma-observacoes').value = turma.observacoes || '';
            
            // Carregar novos campos
            document.getElementById('turma-turno').value = turma.turno || 'matutino';
            document.getElementById('turma-horario-inicio').value = turma.horario_inicio || '';
            document.getElementById('turma-horario-fim').value = turma.horario_fim || '';
            document.getElementById('turma-carga-horaria').value = turma.carga_horaria || '';
            // Adicione esta linha dentro da sua função editarTurma()
            document.getElementById('turma-sala-fixa').value = turma.sala_fixa_id || '';
            
            // Carregar dias da semana
            document.getElementById('dia-segunda').checked = turma.segunda == 1;
            document.getElementById('dia-terca').checked = turma.terca == 1;
            document.getElementById('dia-quarta').checked = turma.quarta == 1;
            document.getElementById('dia-quinta').checked = turma.quinta == 1;
            document.getElementById('dia-sexta').checked = turma.sexta == 1;
            document.getElementById('dia-sabado').checked = turma.sabado == 1;
            
            const modal = new bootstrap.Modal(document.getElementById('modalTurma'));
            modal.show();
        }

        function salvarTurma() {
            const form = document.getElementById('formTurma');
            const formData = new FormData(form);
            
            const id = document.getElementById('turma-id').value;
            const action = id ? 'atualizar' : 'criar';
            
            fetch(`api/turmas.php?action=${action}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modalTurma')).hide();
                    carregarTurmas();
                    carregarCursos();
                    mostrarSucesso(id ? 'Turma atualizada com sucesso!' : 'Turma criada com sucesso!');
                } else {
                    mostrarErro('Erro ao salvar turma: ' + data.message);
                }
            })
            .catch(error => {
                mostrarErro('Erro na comunicação: ' + error.message);
            });
        }

        function excluirTurma(id) {
            const turma = turmas.find(t => t.id == id);
            if (!turma) return;
            
            if (confirm(`Tem certeza que deseja excluir a turma ${turma.codigo} - ${turma.nome}?`)) {
                fetch(`api/turmas.php?action=excluir&id=${id}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        carregarTurmas();
                        carregarCursos();
                        mostrarSucesso('Turma excluída com sucesso!');
                    } else {
                        mostrarErro('Erro ao excluir turma: ' + data.message);
                    }
                })
                .catch(error => {
                    mostrarErro('Erro na comunicação: ' + error.message);
                });
            }
        }

        function verDetalhes(id) {
            const turma = turmas.find(t => t.id == id);
            if (!turma) return;
            
            const detalhes = `
                Código: ${turma.codigo}
                Nome: ${turma.nome}
                Professor: ${turma.professor}
                Curso: ${turma.curso}
                Número de Alunos: ${turma.num_alunos}
                Tipo de Aula: ${turma.tipo_aula}
                Período: ${turma.periodo}
                Status: ${turma.sala_alocada ? 'Alocada' : 'Pendente'}
                Observações: ${turma.observacoes || 'Nenhuma'}
            `;
            
            alert(detalhes);
        }

        function importarTurmas() {
            const modal = new bootstrap.Modal(document.getElementById('modalImportar'));
            modal.show();
        }

        function executarImportacao() {
            const form = document.getElementById('formImportar');
            const formData = new FormData(form);
            
            fetch('api/turmas.php?action=importar', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modalImportar')).hide();
                    carregarTurmas();
                    carregarCursos();
                    mostrarSucesso(`Importação concluída! ${data.data.importadas} turmas importadas.`);
                } else {
                    mostrarErro('Erro na importação: ' + data.message);
                }
            })
            .catch(error => {
                mostrarErro('Erro na comunicação: ' + error.message);
            });
        }

        function exportarTurmas() {
            window.open('api/turmas.php?action=exportar&formato=csv', '_blank');
        }

        function mostrarSucesso(mensagem) {
            console.log('Sucesso:', mensagem);
            alert(mensagem);
        }

        function mostrarErro(mensagem) {
            console.error('Erro:', mensagem);
            alert(mensagem);
        }
    </script>
</body>
</html>

