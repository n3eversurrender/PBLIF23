import torch

if torch.cuda.is_available():
    print("✅ CUDA is available!")
    print(f"Detected GPU: {torch.cuda.get_device_name(0)}")
else:
    print("❌ CUDA is NOT available.")