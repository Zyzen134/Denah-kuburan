import { db } from '@/db';
import { blocks } from '@/db/schema';
import { NextResponse } from 'next/server';

export async function GET() {
  try {
    const allBlocks = await db.select().from(blocks);
    return NextResponse.json(allBlocks);
  } catch (error) {
    console.error('Error fetching blocks:', error);
    return NextResponse.json({ error: 'Failed to fetch blocks' }, { status: 500 });
  }
}

export async function POST(request: Request) {
  try {
    const body = await request.json();
    const { name, description, capacity } = body;

    const newBlock = await db.insert(blocks).values({
      name,
      description,
      capacity: capacity || 0,
    }).returning();

    return NextResponse.json(newBlock[0]);
  } catch (error) {
    console.error('Error creating block:', error);
    return NextResponse.json({ error: 'Failed to create block' }, { status: 500 });
  }
}
