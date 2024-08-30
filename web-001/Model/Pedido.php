
<?php
class Pedido {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findAllByUser($usuario_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Pedidos WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }

    public function create($usuario_id, $estado_pedido) {
        $stmt = $this->pdo->prepare("INSERT INTO Pedidos (usuario_id, estado_pedido) VALUES (?, ?)");
        return $stmt->execute([$usuario_id, $estado_pedido]);
    }
}
?>
