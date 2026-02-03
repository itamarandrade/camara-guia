#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
SRC_DIR="$ROOT_DIR/library"
DST_DIR="$ROOT_DIR/assets"
WATCH=false

usage() {
  cat <<'USAGE'
Uso:
  ./scripts/sync-assets.sh [--watch]

Opcoes:
  --watch     Mantem sincronizacao automatica enquanto houver mudancas
  -h, --help  Mostra esta ajuda
USAGE
}

if [[ $# -gt 0 ]]; then
  case "${1:-}" in
    --watch)
      WATCH=true
      ;;
    -h|--help)
      usage
      exit 0
      ;;
    *)
      echo "Opcao desconhecida: $1" >&2
      usage >&2
      exit 1
      ;;
  esac
fi

if [[ ! -d "$SRC_DIR" ]]; then
  echo "Erro: pasta de origem nao encontrada: $SRC_DIR" >&2
  exit 1
fi

# Cria a pasta de destino se nao existir
if [[ ! -d "$DST_DIR" ]]; then
  mkdir -p "$DST_DIR"
fi

sync_once() {
  # Sincroniza assets para ficar identica a library
  rsync -a --delete "$SRC_DIR/" "$DST_DIR/"
  echo "Sincronizado: $SRC_DIR -> $DST_DIR"
}

if [[ "$WATCH" == true ]]; then
  if ! command -v inotifywait >/dev/null 2>&1; then
    echo "Erro: inotifywait nao encontrado. Instale o pacote inotify-tools." >&2
    exit 1
  fi

  sync_once
  echo "Modo watch ativo. Aguardando mudancas em: $SRC_DIR"

  while inotifywait -r -e modify,create,delete,move,attrib --quiet "$SRC_DIR"; do
    sync_once
  done
else
  sync_once
fi
